<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order',
        'max_discount',
        'usage_limit',
        'used_count',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_order' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'boolean',
    ];

    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    public function isValidForAmount($subtotal): array
    {
        $today = now()->format('Y-m-d');

        if (!$this->status) {
            return ['valid' => false, 'message' => 'This coupon is no longer active.'];
        }

        if ($this->start_date && $today < $this->start_date->format('Y-m-d')) {
            return ['valid' => false, 'message' => 'This coupon has not started yet.'];
        }

        if ($this->end_date && $today > $this->end_date->format('Y-m-d')) {
            return ['valid' => false, 'message' => 'This coupon has expired.'];
        }

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return ['valid' => false, 'message' => 'This coupon usage limit has been reached.'];
        }

        if ($this->min_order && $subtotal < $this->min_order) {
            return ['valid' => false, 'message' => 'Minimum order amount must be ₹' . number_format($this->min_order) . ' to use this coupon.'];
        }

        return ['valid' => true, 'message' => 'Coupon is valid'];
    }

    public function calculateDiscount($subtotal): float
    {
        if ($this->type === 'percent') {
            $discount = ($subtotal * $this->value) / 100;
            if ($this->max_discount && $discount > $this->max_discount) {
                $discount = $this->max_discount;
            }
            return (float) min($discount, $subtotal);
        } else {
            return (float) min($this->value, $subtotal);
        }
    }
}

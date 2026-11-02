<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sacred Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #0b0314; color: #f5f0e6; padding: 25px; margin: 0;">
    <div style="max-width: 600px; margin: 0 auto; background: #1a0b2e; border: 1px solid #d4af37; border-radius: 12px; padding: 30px;">
        <div style="text-align: center; margin-bottom: 25px;">
            <h1 style="color: #d4af37; font-family: 'Georgia', serif; margin-bottom: 5px;">✨ ASTROSTORE ✨</h1>
            <p style="color: #c0b3d6; font-size: 14px; margin: 0;">Sacred Vedic Astrological Sanctuary</p>
        </div>

        <h2 style="color: #ff9933; font-size: 20px; border-bottom: 1px solid rgba(212,175,55,0.3); padding-bottom: 10px;">
            Namaste {{ $order->shipping_name }},
        </h2>
        <p style="line-height: 1.6; font-size: 15px; color: #f5f0e6;">
            Your sacred order <strong>#{{ $order->order_number }}</strong> has been received with deep reverence. Our Varanasi Acharyas have initiated the preliminary purification rites for your items.
        </p>

        <h3 style="color: #d4af37; font-size: 16px; margin-top: 25px;">Consecrated Items:</h3>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            @foreach($order->items as $item)
                <tr style="border-bottom: 1px solid rgba(212,175,55,0.2);">
                    <td style="padding: 10px 0; color: #f5f0e6;">{{ $item->name }} (x{{ $item->qty }})</td>
                    <td style="padding: 10px 0; text-align: right; color: #d4af37;">₹{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </table>

        <div style="background: rgba(61,29,107,0.4); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>Subtotal:</span> <strong>₹{{ number_format($order->subtotal, 2) }}</strong>
            </div>
            @if($order->discount > 0)
                <div style="display: flex; justify-content: space-between; margin-bottom: 6px; color: #ff9933;">
                    <span>Coupon Discount ({{ $order->coupon_code }}):</span> <strong>-₹{{ number_format($order->discount, 2) }}</strong>
                </div>
            @endif
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>Vedic Shipping:</span> <strong>₹{{ number_format($order->shipping, 2) }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>Vedic Taxes:</span> <strong>₹{{ number_format($order->tax, 2) }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 18px; color: #d4af37; border-top: 1px solid rgba(212,175,55,0.3); padding-top: 8px; margin-top: 6px;">
                <span>Total Blessed Amount:</span> <strong>₹{{ number_format($order->total, 2) }}</strong>
            </div>
        </div>

        <h3 style="color: #d4af37; font-size: 16px;">Delivery Address:</h3>
        <p style="color: #c0b3d6; font-size: 14px; line-height: 1.6;">
            {{ $order->shipping_name }}<br>
            {{ $order->address }}<br>
            {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}<br>
            Phone: {{ $order->phone }}
        </p>

        <p style="text-align: center; color: #d4af37; font-size: 13px; margin-top: 30px; border-top: 1px solid rgba(212,175,55,0.2); padding-top: 15px;">
            May the celestial planets bestow auspicious blessings upon you and your loved ones.<br>
            © {{ date('Y') }} AstroStore. All Planetary Rights Reserved.
        </p>
    </div>
</body>
</html>

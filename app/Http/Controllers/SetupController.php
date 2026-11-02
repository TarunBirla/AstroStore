<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SetupController extends Controller
{
    public function setup(Request $request)
    {
        $expectedKey = env('SETUP_KEY', 'ASTRO_SETUP_2026_SECRET');
        $isLocked = env('SETUP_LOCKED', false);

        if ($isLocked === true || $isLocked === 'true' || $isLocked === '1') {
            abort(403, 'Database setup is locked for security reasons. Set SETUP_LOCKED=false in .env to unlock.');
        }

        if ($request->query('key') !== $expectedKey) {
            abort(403, 'Unauthorized setup key provided.');
        }

        $logs = [];
        $errors = [];
        $tables = [];
        $status = 'success';

        // 1. Check DB Connection
        try {
            DB::connection()->getPdo();
            $driverName = DB::connection()->getDriverName();
            $dbName = DB::connection()->getDatabaseName();
            $logs[] = "Connected successfully to Database: [{$driverName}] {$dbName}";
        } catch (\Throwable $e) {
            $errors[] = "Database Connection Failed: " . $e->getMessage();
            $status = 'error';
            return view('setup', compact('status', 'logs', 'errors', 'tables'));
        }

        // 2. Run Migrations
        try {
            Artisan::call('migrate', ['--force' => true]);
            $logs[] = "Migrations executed: " . trim(Artisan::output());
        } catch (\Throwable $e) {
            $errors[] = "Migration failed: " . $e->getMessage();
            $status = 'error';
        }

        // 3. Run Seeders
        try {
            Artisan::call('db:seed', ['--force' => true]);
            $logs[] = "Database seeded successfully: " . trim(Artisan::output());
        } catch (\Throwable $e) {
            $errors[] = "Seeding failed: " . $e->getMessage();
            $status = 'error';
        }

        // 4. Storage Link
        try {
            Artisan::call('storage:link');
            $logs[] = "Storage link created: " . trim(Artisan::output());
        } catch (\Throwable $e) {
            $logs[] = "Storage link skipped/note: " . $e->getMessage();
        }

        // 5. Fetch all created tables
        try {
            if ($driverName === 'sqlite') {
                $rawTables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%';");
                foreach ($rawTables as $t) {
                    $tables[] = $t->name;
                }
            } else {
                $rawTables = DB::select('SHOW TABLES');
                $key = 'Tables_in_' . $dbName;
                foreach ($rawTables as $t) {
                    $tables[] = $t->$key ?? reset($t);
                }
            }
        } catch (\Throwable $e) {
            $logs[] = "Could not list tables: " . $e->getMessage();
        }

        return view('setup', compact('status', 'logs', 'errors', 'tables'));
    }
}

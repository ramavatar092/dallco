<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ScanLog;
use App\Models\Payout;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalScans = ScanLog::count();
        $totalScanAmount = ScanLog::sum('scan_amount');
        $totalPayout = Payout::sum('amount');

        $last30Days = Carbon::now()->subDays(30);

        $newUsers = User::where('created_at', '>=', $last30Days)->count();
        $scansLast30 = ScanLog::where('created_at', '>=', $last30Days)->count();
        $amountLast30 = ScanLog::where('created_at', '>=', $last30Days)->sum('scan_amount');
        $payoutLast30 = Payout::where('created_at', '>=', $last30Days)->sum('amount');

        return view('dashboard', compact(
            'totalUsers', 'totalScans', 'totalScanAmount', 'totalPayout',
            'newUsers', 'scansLast30', 'amountLast30', 'payoutLast30'
        ));
    }
}

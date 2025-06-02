<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coupon;
use App\Models\ScanLog;
use Carbon\Carbon;

class CouponScanController extends Controller
{
    /**
     * Scan coupon
     */
    public function store(Request $request)
    {
        // Step 1: Validate request input
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required|string|exists:coupons,coupon_code',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation error.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $couponCode = $request->coupon_code;
        $userId     = Auth::id();

        // Step 2: Fetch coupon and user
        $coupon = Coupon::where('coupon_code', $couponCode)->first();

        if (!$coupon) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid coupon code.'
            ], 404);
        }

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'User not found.'
            ], 404);
        }

        // Step 3: Business logic checks
        if (Carbon::parse($coupon->coupon_expiry)->isPast()) {
            return response()->json([
                'status'  => false,
                'message' => 'Coupon has expired.'
            ], 400);
        }

        if ($coupon->coupon_status === 'cancelled') {
            return response()->json([
                'status'  => false,
                'message' => 'Coupon is cancelled.'
            ], 400);
        }

        if ($coupon->coupon_status === 'used') {
            return response()->json([
                'status'  => false,
                'message' => 'Coupon has already been used.'
            ], 400);
        }

        // Step 4: Process valid coupon inside transaction
        try {
            DB::transaction(function () use ($coupon, $user) {
                // Update coupon
                $coupon->update([
                    'coupon_status'  => 'used',
                    'used_by'        => $user->id,
                    'status_date'    => Carbon::now(),
                ]);

                // Update user account balance
                $user->increment('account_balance', $coupon->coupon_value);

                // Log the scan
                ScanLog::create([
                    'user_id'     => $user->id,
                    'coupon_id'   => $coupon->id,
                    'scan_amount' => $coupon->coupon_value
                ]);
            });

            // Step 5: Return success response after transaction completes
            return response()->json([
                'status'        => true,
                'message'       => 'Coupon used successfully.',
                'coupon_value'  => $coupon->coupon_value,
                'user_account_balance' => $user->fresh()->account_balance,
            ]);

        } catch (\Exception $e) {
            // Handle any unexpected errors during the transaction
            return response()->json([
                'status'  => false,
                'message' => 'Failed to process coupon. Please try again later.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Scan coupon history
     */
    public function getScanHistory(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'User not found.'
            ], 404);
        }

        if ($user->status === 'deactivated') {
            return response()->json([
                'status'  => false,
                'message' => 'User account is deactivated.'
            ], 403);
        }

        try {
            $scanLogs = ScanLog::with('coupon') // eager load coupon
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($log) {
                    return [
                        'coupon_code' => $log->coupon->coupon_code ?? null,
<<<<<<< Updated upstream
                        'scan_amount' => $log->scan_amount,
                        'created_at'  => $log->created_at->toDateTimeString(),
=======
                        'scanamount'  => $log->scanamount,
                        'timestamp'   => $log->created_at->toDateTimeString(),
>>>>>>> Stashed changes
                    ];
                });

            return response()->json([
                'status'  => true,
                'message' => 'Scan history retrieved successfully.',
                'data'    => $scanLogs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch scan history.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Payout;
use Carbon\Carbon;

class PayoutController extends Controller
{
    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                ], 401);
            }

            // Validate input
            $validator = Validator::make($request->all(), [
                'payout_date'  => 'required|date',
                'amount'       => 'required',
                'remark'       => 'required',
                'payment_mode' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Save payout
            $payout = new Payout();
            $payout->user_id      = Auth::id();
            $payout->payout_date  = Carbon::createFromFormat('d-m-Y', $request->payout_date)->format('Y-m-d');;
            $payout->amount       = $request->amount;
            $payout->remark       = $request->remark;
            $payout->payment_mode = $request->payment_mode;
            $payout->save();

            return response()->json([
                'success' => true,
                'message' => 'Payout saved successfully',
                'data'    => $payout,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Register or reject user based on mobile number.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerUser(Request $request)
    {
        $data = $request->only([
            'usermobile',
            'name',
            'city',
            'address',
            'state',
            'pincode',
            'mobile_notification_code',
        ]);

        // Validate required field
        if (empty($data['usermobile'])) {
            return response()->json([
                'status'  => false,
                'message' => 'Mobile number is required.',
            ], 400);
        }

        // Check if mobile number already exists
        $existingUser = User::where('user_mobile', $data['usermobile'])->first();

        if ($existingUser) {
            return response()->json([
                'status'    => true,
                'message'   => 'Mobile number already exists.',
                'user_id'   => $existingUser->id,
            ], 200);
        }

        // Create new user
        $user = User::create([
            'user_mobile'               => $data['usermobile'],
            'name'                      => $data['name'] ?? null,
            'city'                      => $data['city'] ?? null,
            'address'                   => $data['address'] ?? null,
            'state'                     => $data['state'] ?? null,
            'pincode'                   => $data['pincode'] ?? null,
            'mobile_notification_code'  => $data['mobile_notification_code'] ?? null,
            'register_date'             => Carbon::now()->toDateString(),
            'account_balance'           => 0,
        ]);

        return response()->json([
            'status'   => true,
            'message'  => 'User registered successfully.',
            'user_id'  => $user->id,
        ], 201);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * User Login
     */
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|string|max:15'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        $mobile = $request->mobile_number;

        // Find user by mobile number
        $user = User::where('user_mobile', $mobile)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }

        // Check if user is deactive
        if ($user->status === 'deactive') {
            return response()->json([
                'status' => false,
                'message' => 'User account is deactivated.'
            ], 403);
        }

        // Generate token using Laravel Sanctum
        $token = $user->createToken('mobile-login')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully.',
            'data' => [
                'user_id' => $user->id,
                'token' => $token
            ]
        ]);
    }

    /**
     * register
     */
    public function register(Request $request)
    {
        // Validate request with uniqueness check for mobile number
        $validator = Validator::make($request->all(), [
            'mobile_number'              => 'required|string|max:15|unique:users,user_mobile',
            'name'                       => 'nullable|string|max:255',
            'city'                       => 'nullable|string|max:100',
            'address'                    => 'nullable|string|max:255',
            'state'                      => 'nullable|string|max:100',
            'pincode'                    => 'nullable|string|max:10',
            'mobile_notification_code'   => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // Create the user
        $user = User::create([
            'user_mobile'               => $data['mobile_number'],
            'name'                      => $data['name'] ?? null,
            'city'                      => $data['city'] ?? null,
            'address'                   => $data['address'] ?? null,
            'state'                     => $data['state'] ?? null,
            'pincode'                   => $data['pincode'] ?? null,
            'mobile_notification_code' => $data['mobile_notification_code'] ?? null,
            'register_date'            => Carbon::now()->toDateString(),
            'account_balance'          => 0,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully.',
            'data' => [
                'user_id' => $user->id,
                'mobile_number' =>  $user->user_mobile,
            ]
        ], 201);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Ensure User model is imported
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'mobilenumber' => 'required|string|max:15'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        $mobile = $request->mobilenumber;

        // Find user by mobile number
        $user = User::where('user_mobile', $mobile)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }

        // Check if user is deactivated
        if ($user->status === 'deactivated') {
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
}

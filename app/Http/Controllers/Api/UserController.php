<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Models\Message;

class UserController extends Controller
{
    /**
     * Get user details
     */
    public function index()
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access',
                ], 401);
            }

            $user = Auth::user();

            return response()->json([
                'success' => true,
                'message' => 'User retrieved successfully',
                'data'    => new UserResource(Auth::user()),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update Bank Details
     */
    public function updateBankDetails(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                ], 401);
            }

            // Validation rules
            $validator = Validator::make($request->all(), [
                'bank_ifsc'       => 'required|string|max:20',
                'account_number'  => 'required|string|max:50',
                'upi_code'        => 'nullable|string|max:50',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Update user bank details
            $user->bank_ifsc = $request->bank_ifsc;
            $user->account_number = $request->account_number;
            $user->upi_code = $request->upi_code;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Bank details updated successfully',
                'data'    => [
                    'user_id'        => $user->id,
                    'name'           => $user->name,
                    'bank_ifsc'      => $user->bank_ifsc,
                    'account_number' => $user->account_number,
                    'upi_code'       => $user->upi_code,
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * User Message save
      */
    public function saveMessage(Request $request)
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
                'date'        => 'required|date',
                'title'       => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Save message
            $message = new Message();
            $message->user_id     = Auth::id();
            $message->date        = $request->date;
            $message->title       = $request->title;
            $message->description = $request->description;
            $message->save();

            return response()->json([
                'success' => true,
                'message' => 'Message saved successfully',
                'data'    => $message,
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

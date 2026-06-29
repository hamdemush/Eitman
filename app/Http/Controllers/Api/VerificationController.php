<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Verify the user's email address using OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already verified.'
            ], 400);
        }

        $user->markEmailAsVerified();

        return response()->json([
            'status' => 'success',
            'message' => 'Email verified successfully.'
        ]);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend(Request $request)
    {
        $user = $request->user();

        // Prevent resending  already verified
        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already verified.'
            ], 400);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'success',
            'message' => 'Verification link/OTP sent successfully to your email.'
        ]);
    }
}
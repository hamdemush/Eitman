<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PsychologistProfile;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'string', 'in:psychologist,patient'], 
        ]);

        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'], 
            'role' => $validated['role'],
            'status' => 'active', 
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Auth::login($user);

        if ($user->isPsychologist()) {
            PsychologistProfile::create([
                'user_id' => $user->id,
                'is_verified' => false,
            ]);
        }

        $user->notify(new SendOtpNotification($otp));

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => __('messages.register_success'),
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 201);
    }

    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email'],
            'otp' => ['required', 'numeric'],
        ]);

        $user = User::where('email', $validated['email'])
                    ->where('otp', $validated['otp'])
                    ->where('otp_expires_at', '>', now())
                    ->first();

        if (!$user) {
            return response()->json([
                'message' => 'رمز التحقق غير صحيح أو انتهت صلاحيته'
            ], 400);
        }

        $user->email_verified_at = now();
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json([
            'message' => 'تم تأكيد البريد الإلكتروني بنجاح',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'email_verified' => true
            ]
        ], 200);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__('messages.invalid_credentials')],
            ]);
        }

        if ($user->status === 'suspended') {
            return response()->json([
                'message' => __('messages.account_suspended')
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => __('messages.login_success'),
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'email_verified' => $user->hasVerifiedEmail()
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => __('messages.logout_success')
        ], 200);
    }
}
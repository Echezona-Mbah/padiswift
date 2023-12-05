<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\LoginOTPEmail;
use App\Mail\LoginSuccessful;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->email_verified_status == 'no') {
            return response()->json(['error' => 'Email verification required'], 401);
        }

        if ($user && password_verify($request->password, $user->password)) {
            $security_login_otp = $this->generateOTP();
            $expirationTime = now()->addMinutes(5);
            $user->update([
                'security_login_otp' => $security_login_otp,
                'login_otp_expires_at' => $expirationTime,
            ]);
            Mail::to($user->email)->send(new LoginOTPEmail($security_login_otp,$user));

            return response()->json(['message' => 'OTP verification required'],201);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function verifyOTP(Request $request, $email)
    {
        $request->validate([
            'otp' => 'required|string|min:4',
        ]);

        $user = User::where('email', $email)
            ->where('security_login_otp', $request->otp)
            ->where('login_otp_expires_at', '>', now())
            ->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid or expired OTP'], 404);
        }

        if ($user->security_login_otp === $request->otp) {
            $token = $user->createToken('api-token')->plainTextToken;
            Mail::to($user->email)->send(new LoginSuccessful($user));
            $user->makeHidden(['email_verification_otp', 'security_login_otp']);

            return response()->json(['message' => 'Login successful', 'token' => $token, 'user' => $user], 201);
        }

        return response()->json(['error' => 'Invalid OTP'], 401);
    }



    private function generateOTP()
    {
        return rand(1000, 9999);
    }
}

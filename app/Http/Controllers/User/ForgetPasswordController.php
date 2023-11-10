<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $forgot_password_code = $this->generateOTP();
        $expirationTime = now()->addMinutes(2);
        $user->update([
            'forgot_password_code' => $forgot_password_code,
            'forget_password_otp_expires_at' => $expirationTime,
        ]);

        Mail::to($user->email)->send(new ForgetPasswordEmail($forgot_password_code));

        return response()->json(['message' => 'Password reset OTP sent']);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|min:4',
        ]);

        $user = User::where('forgot_password_code', $request->otp)
            ->where('forget_password_otp_expires_at', '>', now())
            ->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid or expired OTP'], 401);
        }

        $user->update([
            'forgot_password_code' => null,
            'forget_password_otp_expires_at' => null,
        ]);

        $token = $user->createToken('password-reset')->plainTextToken;

        return response()->json(['message' => 'OTP verified', 'token' => $token], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->tokens()->delete();

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Password reset successful'], 200);
    }


    private function generateOTP()
    {
        return rand(1000, 9999);
    }
}

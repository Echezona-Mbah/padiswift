<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordEmail;
use App\Mail\ForgetPasswordSuccessFUl;
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

        Mail::to($user->email)->send(new ForgetPasswordEmail($forgot_password_code,$user));

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

        $token = $user->createToken('password-reset')->plainTextToken;


        $user->update([
            'forgot_password_code' => null,
            'forget_password_otp_expires_at' => null,
            'forgot_password_token'=> $token,
        ]);

        Mail::to($user->email)->send(new ForgetPasswordSuccessFUl($user));

        return response()->json(['message' => 'OTP verified', 'token' => $token], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('forgot_password_token', $request->token) ->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->tokens()->delete();

        $user->update([
            'password' => bcrypt($request->password),
            "forgot_password_token"=> NULL,
        ]);

        return response()->json(['message' => 'Password reset successful'], 200);
    }


    private function generateOTP()
    {
        return rand(1000, 9999);
    }
}

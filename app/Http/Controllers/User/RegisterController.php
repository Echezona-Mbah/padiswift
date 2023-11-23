<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\RegisterOTPEmail;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        $email_verification_otp = $this->generateOTP();
        $user->email_verification_otp = $email_verification_otp;
        $expirationTime = now()->addMinutes(5);
        $user->update([
            'email_verification_otp' => $email_verification_otp,
            'email_verification_otp_expires_at' => $expirationTime,
        ]);
        Mail::to($user->email)->send(new RegisterOTPEmail($email_verification_otp,$user));

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['message' => "Registration was successful. Please check your email for verification","details" => "$token"], 201);


        // return response()->json(['token' => $token], 201);
    }


    private function generateOTP()
    {
        return rand(1000, 9999);
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|min:4',
        ]);
        $user = User::where('email_verification_otp', $request->otp)
        ->where('email_verification_otp_expires_at', '>', now())
        ->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid or expired OTP'], 422);
        }

        if ($user->email_verified_at !== null) {
            return response()->json(['message' => 'Email already verified']);
        }

        // Mark the email as verified
        $user->update([
            'email_verified_at' => now(),
            'email_verified_status' => 'yes',
        ]);
        // $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['message' => 'Email verified successfully']);
    }

    public function verifyEmailOtp($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $email_verification_otp = $this->generateOTP();
        $expirationTime = now()->addMinutes(5);

        $user->update([
            'email_verification_otp' => $email_verification_otp,
            'email_verification_otp_expires_at' => $expirationTime,
        ]);

        Mail::to($user->email)->send(new RegisterOTPEmail($email_verification_otp, $user));

        return response()->json(['message' => "New OTP was sent, Please check your email for verification"], 201);
    }


    public function deleteUser($email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->makeHidden(['transaction_pin']);

        return response()->json($user);
    }
}

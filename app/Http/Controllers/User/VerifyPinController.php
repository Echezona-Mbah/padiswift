<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class VerifyPinController extends Controller
{
    public function verifyPinApi(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pin' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        if (!$user->transaction_pin) {
            return response()->json(['error' => 'PIN not set for the user'], 401);
        }
        $attemptsKey = 'pin_attempts_' . $user->id;
        $failedAttempts = Cache::get($attemptsKey, 0);

        if ($failedAttempts >= 3) {
            Cache::put($attemptsKey, $failedAttempts, now()->addMinutes(5));
            return response()->json(['error' => 'Account temporarily blocked. Try again later.'], 401);
        }
        if (!$this->verifyPin($user, $request->pin)) {
            Cache::put($attemptsKey, $failedAttempts + 1, now()->addMinutes(5));
            return response()->json(['error' => 'Incorrect PIN'], 401);
        }

        Cache::forget($attemptsKey);

        return response()->json(['message' => 'PIN verification successful'], 200);
    }

    private function verifyPin($user, $enteredPin)
    {
        $hashedPin = $user->transaction_pin;

        return Hash::check($enteredPin, $hashedPin);
    }

    public function requestUnblock(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $attemptsKey = 'pin_attempts_' . $user->id;

    if (!Cache::has($attemptsKey)) {
        return response()->json(['error' => 'Account is not blocked'], 400);
    }

    // Remove the block
    Cache::forget($attemptsKey);

    return response()->json(['message' => 'Account unblocked successfully'], 200);
}


}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionPinController extends Controller
{
    // public function CreteTransactionPin(Request $request)
    // {
    //     $user = Auth::user();
    //     if (!$user) {
    //         return response()->json(['error' => 'Unauthenticated'], 401);
    //     }
    //     $request->validate([
    //         'pin' => 'required|string|min:6',
    //     ]);


    //     $user = User::create([
    //         'transaction_pin' => bcrypt($request->pin),
    //     ]);

    //     return response()->json(['message' => 'Transaction PIN Create successfully', 'user' => $user], 201);
    // }

    public function updateTransactionPin(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $request->validate([
            'pin' => 'required|digits:6',
        ]);
        $user->update([
            'transaction_pin' => $request->pin,
        ]);

        return response()->json(['message' => 'Transaction PIN updated successfully', 'user' => $user], 200);
    }
}

<?php

namespace App\Http\Controllers\Wallect;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WalletTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WallectTransferContrroller extends Controller
{

    public function transfer(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'padi_tag' => 'required',
        ]);
        $user = Auth::user();
        $sourceUser = User::where('padi_tag',$request->padi_tag)->first();

        if (!$sourceUser || !$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->wallet_balance < $request->amount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }
        $min = ($user->wallet_balance - $request->amount);
        $user->update(['wallet_balance' =>  $min]);
        $sourceUser = User::where('padi_tag',$request->padi_tag)->first();
        $total = $sourceUser->wallet_balance + $request->amount;
        $sourceUser->update(['wallet_balance' =>  $total]);

        $WalletTransfer = WalletTransfer::create([
            'amount' => $request->amount,
            'user_id' => $user->id,
            'sender_padi_tag' =>$user->padi_tag,
            'reciever_padi_tag' => $request->padi_tag,
        ]);

        return response()->json(['message' => 'Transfer successful','detail'=>$WalletTransfer], 200);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PadiTagController extends Controller
{

    public function updatePaditag(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $request->validate([
            'padi_tag' => 'required',
        ]);
        $user->update([
            'padi_tag'=>($request->padi_tag),
        ]);

        return response()->json(['message' => 'PadiTag updated successfully', 'user' => $user], 200);
    }



}

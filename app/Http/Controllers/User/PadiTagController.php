<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'padi_tag' => 'required|unique:users,padi_tag,' . $user->id,
        ]);
        $existingUser = User::where('padi_tag', $request->padi_tag)
            ->where('id', '<>', $user->id)
            ->first();

        if ($existingUser) {
            return response()->json(['error' => 'PadiTag is already in use by another user'], 422);
        }

        $user->update([
            'padi_tag' => $request->padi_tag,
        ]);

        return response()->json(['message' => 'PadiTag updated successfully', 'user' => $user], 200);
    }


    public function getUserByPadiTag($padiTag)
    {
        $user = User::where('padi_tag', $padiTag)->first();

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }



}

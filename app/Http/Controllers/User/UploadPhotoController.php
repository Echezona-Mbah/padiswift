<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadPhotoController extends Controller
{
    public function updatePhoto(Request $request, $id)

    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        Storage::disk('public')->delete('photos/' . $user->profile_picture);

        $newPhoto = $request->file('photo');
        $filename = time() . '_' . $newPhoto->getClientOriginalName();
        $newPhoto->storeAs('photos', $filename, 'public');

        $user->update(['profile_picture' => $filename]);

        return response()->json(['message' => 'Photo updated successfully', 'photo' => $user->profile_picture], 200);
    }



}

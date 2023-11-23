<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageFacade;

class UploadPhotoController extends Controller
{
    public function updatePhoto(Request $request, $id)

    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        Storage::disk('public')->deleteDirectory('photos');

        $newPhoto = $request->file('photo');
        $filename = time() . '_' . $newPhoto->getClientOriginalName();
        $newPhoto->storeAs('photos', $filename, 'public');
        // $compressedImage = ImageFacade::make($newPhoto)->encode('jpg', 80);
        // Storage::disk('public')->put('photos/' . $filename, $compressedImage->stream());

        $user->update(['profile_picture' => $filename]);

        return response()->json(['message' => 'Photo updated successfully', 'photo' => $user->profile_picture], 200);
    }



}

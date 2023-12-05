<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileUpdatedController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'phone' => 'nullable|string',
            'sex' => 'nullable|string|in:female,male',
            'dob' => 'nullable|date',
            'occupation' => 'nullable|string',
            'state_of_origin' => 'nullable|string',
            'country' => 'nullable|string',
            'home_address' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->update ([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'sex' => $request->sex,
            'dob' => $request->dob,
            'occupation' => $request->occupation,
            'state_of_origin' => $request->state_of_origin,
            'country' => $request->country,
            'home_address' => $request->home_address,
        ]);

        if ($request->hasFile('profile_picture')) {
            $this->updateProfilePicture($user, $request->file('profile_picture'));
        }

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user], 200);
    }

    private function updateProfilePicture($user, $file)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        Storage::disk('public')->deleteDirectory('profile_pictures');

        Storage::disk('public')->makeDirectory('profile_pictures');

        if ($user->profile_picture) {
            Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('profile_pictures', $filename, 'public');

        $user->update(['profile_picture' => $filename]);
    }
}

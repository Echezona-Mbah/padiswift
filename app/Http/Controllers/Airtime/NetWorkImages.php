<?php

namespace App\Http\Controllers\Airtime;

use App\Http\Controllers\Controller;
use App\Models\NetWorkImages as ModelsNetWorkImages;
use Illuminate\Http\Request;

class NetWorkImages extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'network_type' => 'required|in:mtn,glo,airtime,9mobile',
        ]);

        $image = $request->file('image');
        $networkType = $request->input('network_type');

        if ($image) {
            $imageName = time() . '.' . $image->extension();
            $image->storeAs("public/network_images/{$networkType}", $imageName);

            ModelsNetWorkImages::create([
                'filename' => $imageName,
                'network_type' => $networkType,
            ]);

            return response()->json(['message' => 'Image uploaded successfully']);
        } else {
            return response()->json(['message' => 'No image was provided.'], 422);
        }
    }

    public function getSupportedNetworks()
{
    $supportedNetworks = ModelsNetWorkImages::all();


    return response()->json($supportedNetworks);
}






}

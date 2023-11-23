<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TopUpController extends Controller
{
    public function backTransfer(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'topup_type' => 'required',
            'email' => 'required|email',
        ]);

        $publicKey = env('FLUTTERWAVE_PUBLIC_KEY');
        $secretKey = env('FLUTTERWAVE_SECRET_KEY');

        $payment = auth()->user()->topups()->create([
            'amount' => $request->input('amount'),
            'topup_type' => $request->input('topup_type'),
        ]);

        $redirectUrl = urlencode('https://www.flutterwave.ng');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $secretKey,
            'Content-Type' => 'application/json',
        ])->post("https://api.flutterwave.com/v3/charges?type=bank_transfer", [
            'amount' => $request->input('amount'),
            'tx_ref' => uniqid(),
            'currency' => 'NGN',
            'redirect_url' => $redirectUrl,
            'payment_type' => 'bank_transfer',
            'order_id' => $payment->id,
            'email' => $request->input('email'),
        ]);

        $responseBody = $response->json();

        if ($responseBody['status'] === 'success') {
            $user = auth()->user();
            $newBalance = $user->wallet_balance + $request->input('amount');
            $user->update(['wallet_balance' => $newBalance]);
            return response()->json(['message' => 'Payment successful','data'=> $responseBody]);
        } else {
            return response()->json(['error' => 'Payment failed'], 400);
        }

        return $response->json();
    }


    public function card(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'topup_type' => 'required',
            'email' => 'required|email',
            'recipient' => 'required',

        ]);

        $publicKey = env('FLUTTERWAVE_PUBLIC_KEY');
        $secretKey = env('FLUTTERWAVE_SECRET_KEY');

        $payment = auth()->user()->topups()->create([
            'amount' => $request->input('amount'),
            'topup_type' => $request->input('topup_type'),
        ]);


        $redirectUrl = urlencode('https://www.flutterwave.ng');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $secretKey,
            'Content-Type' => 'application/json',
        ])->post("https://checkout.flutterwave.com/v3.js", [
            'amount' => $request->input('amount'),
            'tx_ref' => uniqid(),
            'currency' => 'NGN',
            'redirect_url' => $redirectUrl,
            'payment_type' => 'card',
            'order_id' => $payment->id,
            'email' => $request->input('email'),
            'recipient' => $request->input('recipient'),

        ]);

      //  dd($response);die();

        $responseBody = $response->json();

        if ($responseBody['status'] === 'success') {
            $user = auth()->user();
            $newBalance = $user->wallet_balance + $request->input('amount');
            $user->update(['wallet_balance' => $newBalance]);
            return response()->json(['message' => 'Payment successful','data'=> $responseBody]);
        } else {
            return response()->json(['error' => 'Payment failed'], 400);
        }

        return $response->json();
    }





    private function encrypt3DES($data, $key)
    {
        $data = json_encode($data);
        $iv = substr(openssl_random_pseudo_bytes(8), 0, 8);
        $data = $this->pkcs5Pad($data);
        $encryptedData = openssl_encrypt($data, 'des-ede3-cbc', $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);

        return [
            'iv' => base64_encode($iv),
            'payload' => base64_encode($encryptedData),
        ];
    }

    private function pkcs5Pad($text)
    {
        $blocksize = 8;
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }




}

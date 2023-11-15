<?php

namespace App\Http\Controllers\Airtime;

use App\Http\Controllers\Controller;
use App\Models\Airtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AirtimeController extends Controller
{
    public function generateUnixTimestamp()
    {
        date_default_timezone_set('Africa/Lagos');

        $todayDate = date('YmdHi');

        $randomNumbers = mt_rand(100000000000, 999999999999);

        return $todayDate . $randomNumbers;
    }

    public function recharge(Request $request)
    {

        $request->validate([
            'phone_number'=> 'required',
           'amount'=> 'required',
           'network'=> 'required',

       ]);

        $user_id = Auth::user()->id;

        $phoneNumber = $request->input('phone_number');
        $amount = $request->input('amount');
        $selectedNetwork = $request->input('network');


        $response = Http::withHeaders([
            'api-key' => env('VTPASS_TEST_KEY'),
            'secret-key' => env('VTPASS_SECRET_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://sandbox.vtpass.com/api/pay', [
            'phone' => $phoneNumber,
            'amount' => $amount,
            'serviceID' => $selectedNetwork,
            'request_id' => $this->generateUnixTimestamp(),

        ]);
        $responseData = $response->json();
          dd($responseData);die();
        $product_name = $responseData['content']['transactions']['product_name'];
        $unique_element = $responseData['content']['transactions']['unique_element'];
        $unit_price = $responseData['content']['transactions']['unit_price'];
        $quantity = $responseData['content']['transactions']['quantity'];
        $commission = $responseData['content']['transactions']['commission'];
        $total_amount = $responseData['content']['transactions']['total_amount'];
        $email = $responseData['content']['transactions']['email'];
        $transactionId = $responseData['content']['transactions']['transactionId'];
        $requestId = $responseData['requestId'];
        $code = $responseData['code'];


        if ($code == '000') {
            $deposit = Airtime::create([
                'user_id' =>$user_id,
                'transactionId' =>$transactionId,
                'requestId' =>$requestId,
                'amount' =>  $amount,
                'product_name' =>$product_name,
                'unique_element' =>$unique_element,
                'unit_price' =>$unit_price,
                'quantity' =>$quantity,
                'commission' =>$commission,
                'total_amount' =>$total_amount,
                'email' =>$email,
                'requestId' =>$requestId,
            ]);

            return response()->json(['message' => 'Airtime recharge successful']);
        }else {
            return response()->json(['error' => 'Airtime recharge failed', 'details' => $responseData], 500);
        }

    }

}

<?php

namespace App\Http\Controllers\Airtime;

use App\Http\Controllers\Controller;
use App\Models\Airtime;
use App\Models\CommisionSettings;
use App\Models\DataPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class DataController extends Controller
{
    public function generateUnixTimestamp()
{
    date_default_timezone_set('Africa/Lagos');

    // Get today's date in the required format (YYYYMMDDHHII)
    $todayDate = date('YmdHi');

    // Generate a random 12-character string consisting of numbers
    $randomNumbers = mt_rand(100000000000, 999999999999);

    // Combine the date and random numbers to create the final 12-character string
    return $todayDate . $randomNumbers;
}


public function getVariationCodes(Request $request)
{
    $request->validate([
        'serviceID'=> 'required',

   ]);
    $serviceID = $request->input('serviceID');;
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' .  env('VTPASS_TEST_KEY')
    ])->get("https://sandbox.vtpass.com/api/service-variations?serviceID=$serviceID" . 'service-variations', [
        'serviceID' =>    $serviceID
    ]);
    if ($response->successful()) {
        $data = $response->json();
        $DD = $data['content']['serviceID'];
        $DD = $data['content']['varations'];
        return $DD;

        return response()->json(['message' => 'Variation codes retrieved successfully', 'data' => $data], 200);
    } else {
        return response()->json(['message' => 'Error fetching variation codes', 'data' => $response->json()], $response->status());
    }
}


public function data(Request $request)
{
    $request->validate([
        'phone_number'=> 'required',
       'variation_code'=> 'required',
       'service_id'=> 'required',
       'amount'=> 'required',


   ]);

   $user = Auth::user();
   $user_id = Auth::user()->id;
   if($user->wallet_balance < $request->amount){
    return response()->json(['message' => 'Insufficient funds'], 400);
   }

    $phoneNumber = $request->input('phone_number');
    $variation_code = $request->input('variation_code');
    $selectedNetwork = $request->input('service_id');
    $amount = $request->input('amount');


    $response = Http::withHeaders([
        'api-key' => env('VTPASS_TEST_KEY'),
        'secret-key' => env('VTPASS_SECRET_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://sandbox.vtpass.com/api/pay', [
        'phone' => $phoneNumber,
        'amount' => $amount,
        'serviceID' => $selectedNetwork,
        'variation_code' => $variation_code,
        'request_id' => $this->generateUnixTimestamp(),


    ]);


    $responseData = $response->json();
    $status = $responseData['content']['transactions']['status'];
        $product_name = $responseData['content']['transactions']['product_name'];
        $type = $responseData['content']['transactions']['type'];
        $commission = $responseData['content']['transactions']['commission'];
        $total_amount = $responseData['content']['transactions']['total_amount'];
        $email = $responseData['content']['transactions']['email'];
        $transactionId = $responseData['content']['transactions']['transactionId'];
        $requestId = $responseData['requestId'];
    $code = $responseData['code'];

            // $Qcommission = CommisionSettings::where('network', $selectedNetwork)->first();
        // $commissionAmount = ($Qcommission->percentage / 100) * $amount;
        if($request->service_id === 'mtn-data'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*$firstItem->mtn_data;
            if ($code == '000') {
                $Data = DataPurchase::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'requestId' =>$requestId,
                    'amount' =>  $amount,
                    'ServiceName'=>$variation_code,
                    'serviceID'=>$selectedNetwork,
                    'product_name' =>$product_name,
                    'type' =>$type,
                    'cashback' =>$mtncommission,
                    'total_amount' =>$total_amount,
                    'email' =>$email,
                    'phone'=>$phoneNumber,
                    'status'=>$status,
                ]);

                $user = Auth::user();
                $balancecashback = ($user->cashback_balance + $mtncommission);
                $balancewallet = ($user->wallet_balance - $request->amount);
                $user->update([
                    'cashback_balance' => $balancecashback,
                    'wallet_balance' => $balancewallet,
                ]);
                $user->save();

                return response()->json(['message' => 'Data Purchase successful','detail' =>$Data]);
            }else {
                return response()->json(['error' => 'Data Purchase failed', 'details' => $responseData], 500);
            }

        }
        if($request->service_id === 'airtel-data'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*$firstItem->airtel_data;
            if ($code == '000') {
                $Data = DataPurchase::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'requestId' =>$requestId,
                    'amount' =>  $amount,
                    'ServiceName'=>$variation_code,
                    'serviceID'=>$selectedNetwork,
                    'product_name' =>$product_name,
                    'type' =>$type,
                    'cashback' =>$mtncommission,
                    'total_amount' =>$total_amount,
                    'email' =>$email,
                    'phone'=>$phoneNumber,
                    'status'=>$status,
                ]);

                $user = Auth::user();
                $balancecashback = ($user->cashback_balance + $mtncommission);
                $balancewallet = ($user->wallet_balance - $request->amount);
                $user->update([
                    'cashback_balance' => $balancecashback,
                    'wallet_balance' => $balancewallet,
                ]);
                $user->save();

                return response()->json(['message' => 'Data Purchase successful','detail' =>$Data]);
            }else {
                return response()->json(['error' => 'Data Purchase failed', 'details' => $responseData], 500);
            }

        }
        if($request->service_id === 'glo-data'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*$firstItem->glo_data;
            if ($code == '000') {
                $Data = DataPurchase::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'requestId' =>$requestId,
                    'amount' =>  $amount,
                    'ServiceName'=>$variation_code,
                    'serviceID'=>$selectedNetwork,
                    'product_name' =>$product_name,
                    'type' =>$type,
                    'cashback' =>$mtncommission,
                    'total_amount' =>$total_amount,
                    'email' =>$email,
                    'phone'=>$phoneNumber,
                    'status'=>$status,
                ]);

                $user = Auth::user();
                $balancecashback = ($user->cashback_balance + $mtncommission);
                $balancewallet = ($user->wallet_balance - $request->amount);
                $user->update([
                    'cashback_balance' => $balancecashback,
                    'wallet_balance' => $balancewallet,
                ]);
                $user->save();

                return response()->json(['message' => 'Data Purchase successful','detail' =>$Data]);
            }else {
                return response()->json(['error' => 'Data Purchase failed', 'details' => $responseData], 500);
            }

        }
        if($request->service_id === 'etisalat-data'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*$firstItem->etisalat_data;
            if ($code == '000') {
                $Data = DataPurchase::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'requestId' =>$requestId,
                    'amount' =>  $amount,
                    'ServiceName'=>$variation_code,
                    'serviceID'=>$selectedNetwork,
                    'product_name' =>$product_name,
                    'type' =>$type,
                    'cashback' =>$mtncommission,
                    'total_amount' =>$total_amount,
                    'email' =>$email,
                    'phone'=>$phoneNumber,
                    'status'=>$status,
                ]);

                $user = Auth::user();
                $balancecashback = ($user->cashback_balance + $mtncommission);
                $balancewallet = ($user->wallet_balance - $request->amount);
                $user->update([
                    'cashback_balance' => $balancecashback,
                    'wallet_balance' => $balancewallet,
                ]);
                $user->save();

                return response()->json(['message' => 'Data Purchase successful','detail' =>$Data]);
            }else {
                return response()->json(['error' => 'Data Purchase failed', 'details' => $responseData], 500);
            }

        }
        if($request->service_id === 'smile-direct'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*$firstItem->smile_direct;
            if ($code == '000') {
                $Data = DataPurchase::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'requestId' =>$requestId,
                    'amount' =>  $amount,
                    'ServiceName'=>$variation_code,
                    'serviceID'=>$selectedNetwork,
                    'product_name' =>$product_name,
                    'type' =>$type,
                    'cashback' =>$mtncommission,
                    'total_amount' =>$total_amount,
                    'email' =>$email,
                    'phone'=>$phoneNumber,
                    'status'=>$status,
                ]);

                $user = Auth::user();
                $balancecashback = ($user->cashback_balance + $mtncommission);
                $balancewallet = ($user->wallet_balance - $request->amount);
                $user->update([
                    'cashback_balance' => $balancecashback,
                    'wallet_balance' => $balancewallet,
                ]);
                $user->save();

                return response()->json(['message' => 'Data Purchase successful','detail' =>$Data]);
            }else {
                return response()->json(['error' => 'Data Purchase failed', 'details' => $responseData], 500);
            }

        }
        if($request->service_id === 'spectranet'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*$firstItem->spectranet;
            if ($code == '000') {
                $Data = DataPurchase::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'requestId' =>$requestId,
                    'amount' =>  $amount,
                    'ServiceName'=>$variation_code,
                    'serviceID'=>$selectedNetwork,
                    'product_name' =>$product_name,
                    'type' =>$type,
                    'cashback' =>$mtncommission,
                    'total_amount' =>$total_amount,
                    'email' =>$email,
                    'phone'=>$phoneNumber,
                    'status'=>$status,
                ]);

                $user = Auth::user();
                $balancecashback = ($user->cashback_balance + $mtncommission);
                $balancewallet = ($user->wallet_balance - $request->amount);
                $user->update([
                    'cashback_balance' => $balancecashback,
                    'wallet_balance' => $balancewallet,
                ]);
                $user->save();

                return response()->json(['message' => 'Data Purchase successful','detail' =>$Data]);
            }else {
                return response()->json(['error' => 'Data Purchase failed', 'details' => $responseData], 500);
            }

        }

}


public function getDateHistory()
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }
    $airtimeHistory = DataPurchase::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

    return response()->json(['data_history' => $airtimeHistory], 200);
}


}

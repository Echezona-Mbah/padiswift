<?php

namespace App\Http\Controllers\Airtime;

use App\Http\Controllers\Controller;
use App\Models\DataPrincing;
use App\Models\CommisionSettings;
use App\Models\DataPurchase;
use App\Models\GeneralSettings;
use App\Models\User;
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


public function getVariationCodes()
{
    $dataPricings = DataPrincing::all();
    return response()->json($dataPricings);

//     $request->validate([
//         'serviceID'=> 'required',

//    ]);
//     $serviceID = $request->input('serviceID');;
//     $response = Http::withHeaders([
//         'Authorization' => 'Bearer ' .  env('VTPASS_TEST_KEY')
//     ])->get("https://sandbox.vtpass.com/api/service-variations?serviceID=$serviceID" . 'service-variations', [
//         'serviceID' =>    $serviceID
//     ]);
//     if ($response->successful()) {
//         $data = $response->json();
//         $DD = $data['content']['serviceID'];
//         $DD = $data['content']['varations'];
//         return $DD;

//         return response()->json(['message' => 'Variation codes retrieved successfully', 'data' => $data], 200);
//     } else {
//         return response()->json(['message' => 'Error fetching variation codes', 'data' => $response->json()], $response->status());
//     }
}


public function data(Request $request)
{
    $request->validate([
        'MobileNumber' => 'required',
        'MobileNetwork' => 'required',
        'DataPlan' => 'required',
    ]);

    $user = Auth::user();
    $user_id = Auth::user()->id;
    if($user->transaction_pin == null){
        return response()->json(['message' => 'Set pin'], 400);
       }

    if (!$this->verifyPin($user, $request->pin)) {
        return response()->json(['error' => 'Incorrect PIN'], 401);
    }

    if($user->wallet_balance < $request->amount){
     return response()->json(['message' => 'Insufficient funds'], 400);
    }

    $clubkonnetUserId = env('CLUB_KONNECT_USER');
    $clubkonnetApiKey = env('CLUB_KONNECT_KEY');

    $mobileNumber = $request->MobileNumber;
    $mobileNetwork = $request->MobileNetwork;
    $dataPlan = $request->DataPlan;
    $requestId = $this->generateUnixTimestamp();
    $callbackUrl = 'https://www.vtpass.com/insurance';

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->get('https://www.nellobytesystems.com/APIDatabundleV1.asp', [
        'UserID' => $clubkonnetUserId,
        'APIKey' => $clubkonnetApiKey,
        'MobileNumber' => $mobileNumber,
        'DataPlan' => $dataPlan,
        'MobileNetwork' => $mobileNetwork,
        'CallBackURL' => $callbackUrl,
        'RequestID' => $requestId,
    ]);

    $responseData = $response->json();
      //dd( $responseData);die();
        $status = $responseData['status'];
        $transactionId = $responseData['orderid'];
        $productname = $responseData['productname'];
        $mobilenetwork2 = $responseData['mobilenetwork'];
        $code = $responseData['statuscode'];
        if($mobilenetwork2 === 'MTN'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*2;
            if ($transactionId !== null) {
                $Data = DataPurchase::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'amount' =>  $request->DataPlan,
                    'serviceID'=>$mobileNetwork,
                    'product_name' =>$productname,
                    'cashback' =>$mtncommission,
                    'email' =>Auth::user()->email,
                    'phone'=>$mobileNumber,
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
        if($mobilenetwork2 === 'Airtel'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*$firstItem->airtel_data;
            if ($transactionId !== null) {
                $Data = DataPurchase::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'amount' =>  $request->DataPlan,
                    'serviceID'=>$mobileNetwork,
                    'product_name' =>$productname,
                    'cashback' =>$mtncommission,
                    'email' =>Auth::user()->email,
                    'phone'=>$mobileNumber,
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
        if($mobilenetwork2 === 'Glo'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*$firstItem->glo_data;
            if ($transactionId !== null) {
                $Data = DataPurchase::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'amount' =>  $request->DataPlan,
                    'serviceID'=>$mobileNetwork,
                    'product_name' =>$productname,
                    'cashback' =>$mtncommission,
                    'email' =>Auth::user()->email,
                    'phone'=>$mobileNumber,
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
        if($mobilenetwork2 === 'Etisalat'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*$firstItem->etisalat_data;
            if ($transactionId !== null) {
                $Data = DataPurchase::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'amount' =>  $request->DataPlan,
                    'serviceID'=>$mobileNetwork,
                    'product_name' =>$productname,
                    'cashback' =>$mtncommission,
                    'email' =>Auth::user()->email,
                    'phone'=>$mobileNumber,
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
        // if($request->MobileNetwork === 'MTN'){
        //     $Qcommission = CommisionSettings::all();
        //     $firstItem = $Qcommission->first();
        //     $mtncommission = ($request->amount/100)*$firstItem->smile_direct;
        //     if ($code == '100') {
        //         $Data = DataPurchase::create([
        //             'user_id' =>$user_id,
        //             'transactionId' =>$transactionId,
        //             'amount' =>  $request->DataPlan,
        //             'serviceID'=>$mobileNetwork,
        //             'product_name' =>$productname,
        //             'cashback' =>$mtncommission,
        //             'email' =>Auth::user()->email,
        //             'phone'=>$mobileNumber,
        //             'status'=>$status,
        //         ]);

        //         $user = Auth::user();
        //         $balancecashback = ($user->cashback_balance + $mtncommission);
        //         $balancewallet = ($user->wallet_balance - $request->amount);
        //         $user->update([
        //             'cashback_balance' => $balancecashback,
        //             'wallet_balance' => $balancewallet,
        //         ]);
        //         $user->save();

        //         return response()->json(['message' => 'Data Purchase successful','detail' =>$Data]);
        //     }else {
        //         return response()->json(['error' => 'Data Purchase failed', 'details' => $responseData], 500);
        //     }

        // }
        // if($request->MobileNetwork === 'MTN'){
        //     $Qcommission = CommisionSettings::all();
        //     $firstItem = $Qcommission->first();
        //     $mtncommission = ($request->amount/100)*$firstItem->spectranet;
        //     if ($code == '100') {
        //         $Data = DataPurchase::create([
        //             'user_id' =>$user_id,
        //             'transactionId' =>$transactionId,
        //             'amount' =>  $request->DataPlan,
        //             'serviceID'=>$mobileNetwork,
        //             'product_name' =>$productname,
        //             'cashback' =>$mtncommission,
        //             'email' =>Auth::user()->email,
        //             'phone'=>$mobileNumber,
        //             'status'=>$status,
        //         ]);

        //         $user = Auth::user();
        //         $balancecashback = ($user->cashback_balance + $mtncommission);
        //         $balancewallet = ($user->wallet_balance - $request->amount);
        //         $user->update([
        //             'cashback_balance' => $balancecashback,
        //             'wallet_balance' => $balancewallet,
        //         ]);
        //         $user->save();

        //         return response()->json(['message' => 'Data Purchase successful','detail' =>$Data]);
        //     }else {
        //         return response()->json(['error' => 'Data Purchase failed', 'details' => $responseData], 500);
        //     }

        // }

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

    public function getAllTable()
{
    $perPage = 1;

    $userData = User::with(['airtimes', 'data_purchases', 'electricities'])
                    ->paginate($perPage);

    return response()->json($userData);
}

// public function getSupportedNetworks()
// {
//     $supportedNetworks = GeneralSettings::all();

//     foreach ($supportedNetworks as $settings) {
//         $originalAttributes = $settings->getOriginal();
//         // dd($originalAttributes);
//         $MTN = $settings->MTN;
//         $Etisalat = $settings->Etisalat;
//         $Airtime = $settings->Airtime;
//         $Glo = $settings->Glo;
//     }

//     return response()->json($supportedNetworks);
// }


   // info('API Response:', [
    //     'headers' => $response->headers(),
    //     'body' => $response->body(),
    // ]);
}

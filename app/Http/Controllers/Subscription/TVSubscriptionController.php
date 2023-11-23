<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\CommisionSettings;
use App\Models\TVSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class TVSubscriptionController extends Controller
{
    // public function getDetails(Request $request)
    // {
    //     $tv = $request->input('smartcard_number');
    //     $details = $this->getVariationCodes($tv);


    //     return response()->json($details);

    // }

    public function generateUnixTimestamp()
    {
        date_default_timezone_set('Africa/Lagos');
        $todayDate = date('YmdHi');

        $randomNumbers = mt_rand(100000000000, 999999999999);

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

    public function authoriz(){
        return Http::baseUrl(env('VTPASS_TEST_URL'))->withHeaders([
            'Authorization' => "Basic ".env('VTPASS_TEST_KEY'),
          	'api-key' => env('VTPASS_TEST_KEY'),
          	'secret-key' => env('VTPASS_SECRET_KEY'),
          	'public-key' => env('VTPASS_PUBLIC_KEY')
        ]);
    }

    public function verifyDSTVSmartcard(Request $request)
    {

        $request->validate([
            'billersCode'=> 'required',
            'serviceID'=> 'required',

       ]);


         try {
             $response = $this->authoriz()->post('/merchant-verify', [
                'billersCode' => $request->billersCode,
                'serviceID' =>  $request->serviceID,
            ]);

            $responseArray = $response->json();
            $data = $responseArray['content'];
            //   dd( $data);die();


            if (isset($responseArray['message'])) {
                return response()->json(['message' => $responseArray['message'], 'data' => $responseArray['data']], $response->status());
            } else {

                return response()->json(['success' => true, 'data' => $data ]);            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error verifying smartcard', 'data' => $e->getMessage()], 500);
        }

    }

    public function purchaseSubscription(Request $request)
{
    $request->validate([
        'tv'=> 'required',
       'smartcard_number'=> 'required',
       'subscription_type'=> 'required',
       'variation_code'=> 'required',
       'phone_number'=> 'required',

   ]);

   $user = Auth::user();
   $user_id = Auth::user()->id;
   if($user->wallet_balance < $request->amount){
    return response()->json(['message' => 'Insufficient funds'], 400);
   }

    $tv = $request->input('tv');
    $smartcard_number = $request->input('smartcard_number');
    $subscription_type = $request->input('subscription_type');
    $variation_code = $request->input('variation_code');
    $amount = $request->input('amount');
    $phone_number = $request->input('phone_number');
    // print($subscription_type);die();


    $response = $this->authoriz()->post('/pay', [
        'serviceID' => $tv,
        'billersCode' => $smartcard_number,
        'subscription_type' => $subscription_type,
        'variation_code' => $variation_code,
        'amount' => $amount,
        'request_id' => $this->generateUnixTimestamp(),
        'phone' => $phone_number,
        'quantity'=> 1,



    ]);

    $responseData = $response->json();
    $product_name = $responseData['content']['transactions']['product_name'];
    $unique_element = $responseData['content']['transactions']['unique_element'];
    $unit_price = $responseData['content']['transactions']['unit_price'];
    $quantity = $responseData['content']['transactions']['quantity'];
    $commission = $responseData['content']['transactions']['commission'];
    $type = $responseData['content']['transactions']['type'];
    $status = $responseData['content']['transactions']['status'];
    $total_amount = $responseData['content']['transactions']['total_amount'];
    $email = $responseData['content']['transactions']['email'];
    $unit_price = $responseData['content']['transactions']['unit_price'];
    $transactionId = $responseData['content']['transactions']['transactionId'];
    $requestId = $responseData['requestId'];
    $code = $responseData['code'];
    //dd($responseData);die();

    if($request->tv === 'dstv'){
        $Qcommission = CommisionSettings::all();
        $firstItem = $Qcommission->first();
        $mtncommission = ($unit_price/100)*$firstItem->dstv;
        if ($code == '000') {
            $Data = TVSubscription::create([
                'user_id' =>$user_id,
                'transactionId' =>$transactionId,
                'requestId' =>$requestId,
                'amount' =>  $unit_price,
                'ServiceName'=>$variation_code,
                'serviceID'=>$tv,
                'product_name' =>$product_name,
                'type' =>$type,
                'cashback' =>$mtncommission,
                'total_amount' =>$total_amount,
                'email' =>$email,
                'phone'=>$phone_number,
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

    if($request->tv === 'gotv'){
        $Qcommission = CommisionSettings::all();
        $firstItem = $Qcommission->first();
        $mtncommission = ($unit_price/100)*$firstItem->gotv;
        if ($code == '000') {
            $Data = TVSubscription::create([
                'user_id' =>$user_id,
                'transactionId' =>$transactionId,
                'requestId' =>$requestId,
                'amount' =>  $unit_price,
                'ServiceName'=>$variation_code,
                'serviceID'=>$tv,
                'product_name' =>$product_name,
                'type' =>$type,
                'cashback' =>$mtncommission,
                'total_amount' =>$total_amount,
                'email' =>$email,
                'phone'=>$phone_number,
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

    if($request->tv === 'startimes'){
        $Qcommission = CommisionSettings::all();
        $firstItem = $Qcommission->first();
        $mtncommission = ($unit_price/100)*$firstItem->startimes;
        if ($code == '000') {
            $Data = TVSubscription::create([
                'user_id' =>$user_id,
                'transactionId' =>$transactionId,
                'requestId' =>$requestId,
                'amount' =>  $unit_price,
                'ServiceName'=>$variation_code,
                'serviceID'=>$tv,
                'product_name' =>$product_name,
                'type' =>$type,
                'cashback' =>$mtncommission,
                'total_amount' =>$total_amount,
                'email' =>$email,
                'phone'=>$phone_number,
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

    if($request->tv === 'showmax'){
        $Qcommission = CommisionSettings::all();
        $firstItem = $Qcommission->first();
        $mtncommission = ($unit_price/100)*$firstItem->showmax;
        if ($code == '000') {
            $Data = TVSubscription::create([
                'user_id' =>$user_id,
                'transactionId' =>$transactionId,
                'requestId' =>$requestId,
                'amount' =>  $unit_price,
                'ServiceName'=>$variation_code,
                'serviceID'=>$tv,
                'product_name' =>$product_name,
                'type' =>$type,
                'cashback' =>$mtncommission,
                'total_amount' =>$total_amount,
                'email' =>$email,
                'phone'=>$phone_number,
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


    public function getTVHistory()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        $airtimeHistory = TVSubscription::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return response()->json(['tv_history' => $airtimeHistory], 200);
    }

    // private function verifyPin($user, $enteredPin)
    // {
    //     $hashedPin = $user->transaction_pin;

    //     return Hash::check($enteredPin, $hashedPin);
    // }

}

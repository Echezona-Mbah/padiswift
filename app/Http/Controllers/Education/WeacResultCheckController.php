<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\CommisionSettings;
use App\Models\WeacResultCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class WeacResultCheckController extends Controller
{
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



    public function purchaseWaecchack(Request $request)
    {
        $request->validate([
            'serviceID'=> 'required',
            'variation_code'=> 'required',
            'amount'=> 'required',
            'phone_number'=> 'required',

       ]);
       $user = Auth::user();
       $user_id = Auth::user()->id;
       if($user->wallet_balance < $request->amount){
        return response()->json(['message' => 'Insufficient funds'], 400);
       }


        try {
            $response = $this->authoriz()->post('/pay', [
               'serviceID' => $request->serviceID,
               'variation_code' =>  $request->variation_code,
               'amount' => $request->amount,
               'phone' => $request->phone_number,
               'request_id' => $this->generateUnixTimestamp(),

           ]);

           $responseData = $response->json();
           $product_name = $responseData['content']['transactions']['product_name'];
           $commission = $responseData['content']['transactions']['commission'];
           $type = $responseData['content']['transactions']['type'];
           $status = $responseData['content']['transactions']['status'];
           $total_amount = $responseData['content']['transactions']['total_amount'];
           $email = $responseData['content']['transactions']['email'];
           $unit_price = $responseData['content']['transactions']['unit_price'];
           $transactionId = $responseData['content']['transactions']['transactionId'];
            $Serial = $responseData['cards']['0']['Serial'];
            $Pin = $responseData['cards']['0']['Pin'];
           $requestId = $responseData['requestId'];
           $code = $responseData['code'];
            //dd($responseData);die();

          // $data = $responseArray['content'];
          if($request->serviceID === 'waec'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*3;
            if ($code == '000') {
                $Data = WeacResultCheck::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'Serial_No' =>$Serial,
                    'Pin_No' =>$Pin,
                    'requestId' =>$requestId,
                    'amount' => $request->amount,
                    'ServiceName'=>$request->variation_code,
                    'serviceID'=>$request->serviceID,
                    'product_name' =>$product_name,
                    'type' =>$type,
                    'cashback' =>$mtncommission,
                    'total_amount' =>$total_amount,
                    'email' =>$email,
                    'phone'=>$request->phone_number,
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

                return response()->json(['message' => 'Waec Result check Purchase successful','detail' =>$Data]);
            }else {
                return response()->json(['error' => 'Waec Result check Purchase failed', 'details' => $responseData], 500);
            }

        }


       } catch (\Exception $e) {
           return response()->json(['message' => 'Failed to verify Waec Result check', 'data' => $e->getMessage()], 500);
       }


    }

    public function getWeacCheckHistory()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        $airtimeHistory = WeacResultCheck::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return response()->json(['tv_history' => $airtimeHistory], 200);
    }



}

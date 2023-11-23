<?php

namespace App\Http\Controllers\Electricity;

use App\Http\Controllers\Controller;
use App\Models\CommisionSettings;
use App\Models\Electricity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ElectricityController extends Controller
{

    public function generateUnixTimestamp()
    {
        date_default_timezone_set('Africa/Lagos');

        $todayDate = date('YmdHi');

        $randomNumbers = mt_rand(100000000000, 999999999999);

        return $todayDate . $randomNumbers;
    }



    public function authoriz(){
        return Http::baseUrl(env('VTPASS_TEST_URL'))->withHeaders([
            'Authorization' => "Basic ".env('VTPASS_TEST_KEY'),
          	'api-key' => env('VTPASS_TEST_KEY'),
          	'secret-key' => env('VTPASS_SECRET_KEY'),
          	'public-key' => env('VTPASS_PUBLIC_KEY')
        ]);
    }


    public function verifyMeterNumber(Request $request)
    {
        $request->validate([
            'serviceID'=> 'required',
            'billersCode'=> 'required',
            'type'=> 'required',

       ]);

        $response =  $this->authoriz()->post('/merchant-verify', [
            'serviceID' => $request->serviceID,
            'billersCode' => $request->billersCode,
            'type' => $request->type,
        ]);

        $verificationResult = $response->json();
        // dd( $verificationResult);
        return response()->json(['verification_result' => $verificationResult], 200);
    }



    public function purchaseElectricity(Request $request)
    {
        $request->validate([
            'serviceID'=> 'required',
            'billersCode'=> 'required',
            'variation_code'=> 'required',
            'amount'=> 'required',
            'phone_number'=> 'required',
       ]);
       $user = Auth::user();
       $user_id = Auth::user()->id;
       if($user->wallet_balance < $request->amount){
        return response()->json(['message' => 'Insufficient funds'], 400);
        try {
            $response = $this->authoriz()->post('/pay', [
               'billersCode' => $request->billersCode,
               'serviceID' => $request->serviceID,
               'variation_code' => $request->variation_code,
               'amount' => $request->amount,
               'phone' => $request->phone_number,
               'request_id' => $this->generateUnixTimestamp(),

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
            $purchased_code = $responseData['purchased_code'];
            $customerName = $responseData['customerName'];
            $units = $responseData['units'];
            $code = $responseData['code'];
         // dd($responseData);die();

            if($request->serviceID === 'ikeja-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->ikeja_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }
            if($request->serviceID === 'eko-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->eko_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }
            if($request->serviceID === 'kano-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->kano_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }
            if($request->serviceID === 'portharcourt-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->portharcourt_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }
            if($request->serviceID === 'jos-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->jos_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }
            if($request->serviceID === 'ibadan-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->ibadan_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }
            if($request->serviceID === 'kaduna-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->kaduna_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }
            if($request->serviceID === 'abuja-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->abuja_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }
            if($request->serviceID === 'enugu-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->enugu_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }
            if($request->serviceID === 'benin-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->benin_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }
            if($request->serviceID === 'aba-electric'){
                $Qcommission = CommisionSettings::all();
                $firstItem = $Qcommission->first();
                $mtncommission = ($request->amount/100)*$firstItem->aba_electric;
                if ($code == '000') {
                    $Data = Electricity::create([
                        'user_id' =>$user_id,
                        'transactionId' =>$transactionId,
                        'requestId' =>$requestId,
                        'purchasedToken' =>$purchased_code,
                        'customerName' =>$customerName,
                        'units' =>$units,
                        'amount' =>  $request->amount,
                        'serviceID'=> $request->serviceID,
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

                    return response()->json(['message' => 'Electricity Purchase successful','detail' =>$Data]);
                }else {
                    return response()->json(['error' => 'Electricity Purchase failed', 'details' => $responseData], 500);
                }

            }

        if ($code == '013') {
            return response()->json(['error' => 'BELOW_MINIMUM_AMOUNT_ALLOWED'], 400);
        }

       } catch (\Exception $e) {
           return response()->json(['message' => 'Failed to verify meter number', 'data' => $e->getMessage()], 500);
       }


    }

    public function getElectricityHistory()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        $airtimeHistory = Electricity::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return response()->json(['tv_history' => $airtimeHistory], 200);
    }



}

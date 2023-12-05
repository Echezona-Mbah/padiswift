<?php

namespace App\Http\Controllers\Airtime;

use App\Http\Controllers\Controller;
use App\Models\Airtime;
use App\Models\CommisionSettings;
use App\Models\User;
use App\Notifications\AirtimeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
           'pin'=> 'required',


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
        $status = $responseData['content']['transactions']['status'];
        $product_name = $responseData['content']['transactions']['product_name'];
        $type = $responseData['content']['transactions']['type'];
        $commission = $responseData['content']['transactions']['commission'];
        $total_amount = $responseData['content']['transactions']['total_amount'];
        $email = $responseData['content']['transactions']['email'];
        $transactionId = $responseData['content']['transactions']['transactionId'];
        $requestId = $responseData['requestId'];
        $code = $responseData['code'];
        // dd($responseData);die();
        if($request->network === 'mtn'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*2;
            if ($code == '000') {
                $Airtime = Airtime::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'requestId' =>$requestId,
                    'amount' =>  $amount,
                    'product_name' =>$product_name,
                    'type' =>$type,
                    'cashback' =>$mtncommission,
                    'total_amount' =>$total_amount,
                    'email' =>$email,
                    'phone'=>$phoneNumber,
                    'status'=>$status,
                ]);
                $user = Auth::user();
                $user = Auth::user();
                $balancecashback = ($user->cashback_balance + $mtncommission);
                $balancewallet = ($user->wallet_balance - $request->amount);
                $user->update([
                    'cashback_balance' => $balancecashback,
                    'wallet_balance' => $balancewallet,
                ]);
                $user->save();
                $user->notify(new AirtimeNotification());


                return response()->json(['message' => 'Airtime recharge successful','detail' =>$Airtime]);
            }else {
                return response()->json(['error' => 'Airtime recharge failed', 'details' => $responseData], 500);
            }
        }

        if($request->network === 'glo'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*2;
            if ($code == '000') {
                $Airtime = Airtime::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'requestId' =>$requestId,
                    'amount' =>  $amount,
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
                $user->notify(new AirtimeNotification());

                return response()->json(['message' => 'Airtime recharge successful','detail' =>$Airtime]);
            }else {
                return response()->json(['error' => 'Airtime recharge failed', 'details' => $responseData], 500);
            }
        }

        if($request->network === 'airtel'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*2;
            if ($code == '000') {
                $Airtime = Airtime::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'requestId' =>$requestId,
                    'amount' =>  $amount,
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
                $user->notify(new AirtimeNotification());

                return response()->json(['message' => 'Airtime recharge successful','detail' =>$Airtime]);
            }else {
                return response()->json(['error' => 'Airtime recharge failed', 'details' => $responseData], 500);
            }
        }

        if($request->network === 'etisalat'){
            $Qcommission = CommisionSettings::all();
            $firstItem = $Qcommission->first();
            $mtncommission = ($request->amount/100)*2;
            if ($code == '000') {
                $Airtime = Airtime::create([
                    'user_id' =>$user_id,
                    'transactionId' =>$transactionId,
                    'requestId' =>$requestId,
                    'amount' =>  $amount,
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
                $user->notify(new AirtimeNotification());

                return response()->json(['message' => 'Airtime recharge successful','detail' =>$Airtime]);
            }else {
                return response()->json(['error' => 'Airtime recharge failed', 'details' => $responseData], 500);
            }
        }


    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $usersWithData = User::with(['airtimes', 'data_purchases'])->where('id', $user->id)->get();
        $filteredData = $usersWithData->map(function ($user) {
            return [
                'airtimes' => $user->airtimes,
                'data_purchases' => $user->data_purchases,
            ];
        });

        return response()->json($filteredData);
    }


        private function verifyPin($user, $enteredPin)
    {
        $hashedPin = $user->transaction_pin;

        return Hash::check($enteredPin, $hashedPin);
    }

    public function getAirtimeHistory()
        {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            $airtimeHistory = Airtime::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

            return response()->json(['airtime_history' => $airtimeHistory], 200);
        }


}

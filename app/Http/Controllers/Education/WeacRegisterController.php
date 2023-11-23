<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WeacRegisterController extends Controller
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



    public function purchaseWaecRegister(Request $request)
    {
        $request->validate([
            'serviceID'=> 'required',
            'variation_code'=> 'required',
            'amount'=> 'required',
            'phone_number'=> 'required',
       ]);
       $user = Auth::user();
       $user_id = Auth::user()->id;
       if (!$this->verifyPin($user, $request->input('pin'))) {
           return response()->json(['error' => 'Incorrect PIN'], 401);
       }

        try {
            $response = $this->authoriz()->post('/pay', [
               'serviceID' => $request->serviceID,
               'variation_code' =>  $request->variation_code ,
               'amount' => $request->amount,
               'phone' => $request->phone_number,
               'request_id' => $this->generateUnixTimestamp(),

           ]);

           $responseArray = $response->json();
            dd( $responseArray);die();

           $code = $responseArray['code'];
        //    dd( $responseArray);die();

          // $data = $responseArray['content'];


           if ($code == '000') {
            return response()->json(['message' => 'Electricity Purchase successful','detail' =>'$Data']);
        }else {
            return response()->json(['error' => 'Electricity Purchase failed', 'details' => '$responseData'], 500);
        }



       } catch (\Exception $e) {
           return response()->json(['message' => 'Failed to verify meter number', 'data' => $e->getMessage()], 500);
       }


    }
}

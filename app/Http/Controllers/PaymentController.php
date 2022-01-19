<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Invitation;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvitationController;

class PaymentController extends Controller
{

    private $apiInvitation;
    private $apiProfile;

    private $isEnable;
    private $isTestModeEnable;
    private $title;
    private $description;
    private $merchantID;
    private $secretKey;
    private $successUrl;
    private $failureUrl;
    private $testBookeeyPaymentGatewayUrl;
    private $liveBookeeyPaymentGatewayUrl;
    private $testBookeeyPaymentRequeryUrl;
    private $liveBookeeyPaymentRequeryUrl;
    private $defaultPaymentOption;
    private $paymentOptions;
    private $amount;
    private $selectedPaymentOption;
    private $orderId;
    private $payerName;
    private $payerPhone;

    public function __construct( InvitationController $apiInvitation, ProfileController $apiProfile)
    {
        // $this->isEnable = IS_ENABLE;
        $this->isEnable =  Config::get('IS_ENABLE') ;
        // $this->isTestModeEnable = IS_TEST_MODE_ENABLE;
        // $this->title = TITLE;
        // $this->description = DESCRIPTION;
        // $this->merchantID = MERCHANT_ID;
        // $this->secretKey = SECRET_KEY;
        $this->successUrl = Config::get('SUCCESS_URL');
        $this->failureUrl = Config::get('FAILURE_URL');
        $this->testBookeeyPaymentGatewayUrl = Config::get('TEST_BOOKEEY_PAYMENT_GATEWAY_URL');
        $this->liveBookeeyPaymentGatewayUrl = Config::get('LIVE_BOOKEEY_PAYMENT_GATEWAY_URL');
        $this->testBookeeyPaymentRequeryUrl = Config::get('TEST_BOOKEEY_PAYMENT_REQUERY_URL');
        $this->liveBookeeyPaymentRequeryUrl = Config::get('LIVE_BOOKEEY_PAYMENT_REQUERY_URL');
        $this->defaultPaymentOption = Config::get('DEFAULT_PAYMENT_OPTION');
        // $this->paymentOptions = PAYMENT_OPTIONS;
        $this->amount = '';
        $this->selectedPaymentOption = $this->defaultPaymentOption;
        $this->orderId = '';
        $this->payerName = '';
        $this->payerPhone = '';

        $this->apiInvitation = $apiInvitation;
        $this->apiProfile = $apiProfile;
    }

    public function payment($status = null, $invitation_uuid = null, Request $request)
    {
        // dd(URL::to('/'));



        $apiInvitationCntrl = $this->apiInvitation;
        $apiResponse = $apiInvitationCntrl->isPayedInvitation($request)->getData();


        $apiInvitationPlayer = $this->apiInvitation;
        $apiResponsePlayer = $apiInvitationPlayer->getInvitation($request)->getData();
        // dd($apiResponse, $apiResponsePlayer);

        $card = Card::where('profile_id', Auth::user()->profile->id)->first();

        if($apiResponse->status == true && $apiResponsePlayer == true)
        {
            $is_payed = $apiResponse->data;
            $playerRecivingPayment = $apiResponsePlayer->data;

            if(isset($status) && "" != $status && isset($invitation_uuid) && '' != $invitation_uuid)
            {
                // dd($status);
                if($status == 'failure')
                {
                    Invitation::where('uuid', $invitation_uuid)->update([
                        'is_payed' => 0
                    ]);
                }
                else {
                    Invitation::where('uuid', $invitation_uuid)->update([
                        'is_payed' => 1
                    ]);
                }

                $apiInvitationCntrl = $this->apiInvitation;
                $apiResponse = $apiInvitationCntrl->isPayedInvitation($request)->getData();
                $is_payed2 = $apiResponse->data;
                // dd($apiResponse);
                // return redirect()->back()->with('status', $status);
                // return redirect()->route('payment', [$status,$invitation_uuid])->with('status', $status);
                return view('payment', ['is_payed' => $is_payed2, 'playerRecivingPayment' => $playerRecivingPayment, 'card' => $card])->with('status', $status);

            }

            return view('payment', ['is_payed' => $is_payed, 'playerRecivingPayment' => $playerRecivingPayment, 'card'=> $card]);
        }
    }

    public function isPlayed($uuid, Request $request)
    {
        $request->merge([
            'invitation_uuid' => $uuid,
            // 'is_payed' => '1',
            'is_attended' => '1',
        ]);
        $apiInvitationCntrl = $this->apiInvitation;
        $apiResponse = $apiInvitationCntrl->updateInvitation($request)->getData();
        // dd($apiResponse->data->invitation[0]->player->uuid);

        if ($apiResponse->status) {
            $invitation_uuid = $apiResponse->data->invitation[0]->uuid;
            // return redirect()->route('pay_now', Auth::user()->profile->uuid);
            return redirect()->route('pay_now', $invitation_uuid);
        }
    }


    public function paymentCancelationData($uuid, Request $request)
    {
        $request->merge([
            'invitation_uuid' => $uuid,
            'is_payed' => '0',
            'is_attended' => '1',
        ]);
        $apiInvitationCntrl = $this->apiInvitation;
        $apiResponse = $apiInvitationCntrl->updateInvitation($request)->getData();
        // dd($apiResponse->data->invitation[0]->player->uuid);

        if ($apiResponse->status) {
            // $player_uuid = $apiResponse->data->invitation[0]->player->uuid;
            return redirect()->route('pay_now', Auth::user()->profile->uuid);
        }
    }


    public function paymentNow($uuid, Request $request)
    {
        // dd($uuid);
        // dd(config('url'));
        // dd($request->all(), $uuid);
        $request->merge([
            'invitation_uuid' => $uuid,
        ]);
        $apiInvitationCntrl = $this->apiInvitation;
        // dd($request->all());
        $apiResponse = $apiInvitationCntrl->getInvitationByUser($request)->getData();
        if($apiResponse->status == true)
        {
            $singleProfile = $apiResponse->data;
            // dd($singleProfile);
            return view('pay_now', ['singleProfile' => $singleProfile, 'invitation_uuid' => $uuid]);
        }
    }

    public function sendPayment($uuid, $price, Request $request)
    {
        // dd($uuid, $request->all());

        $request->merge([
            'profile_uuid' => Auth::user()->profile->uuid,
        ]);
        $apiProfileCntrl = $this->apiProfile;
        $apiResponse = $apiProfileCntrl->getProfile($request)->getData();
        $singleProfile = $apiResponse->data;
        // dd($singleProfile, $uuid);

        $invitation_uuid= $uuid;

        $mid = 'mer2100054';
        $name = $singleProfile->username;
        $email = $singleProfile->user->email;
        $phone = $singleProfile->user->phone_number;
        $phone_code = '+92';
        $merchantIBanNo = $singleProfile->card->Ibn_no;
        $bank_name = $singleProfile->card->account_title_name;
        // $bank_name = $request->payment_method;
        $swift_code = $singleProfile->card->swift_code;

        // $amount = $singleProfile->price;

        $hash_code = $this->hashFunction($email, $phone);
        // dd($request->all(), $hash_code,$name, $email, $phone, $phone_code,$merchantIBanNo, $bank_name, $swift_code);
        // $hash_code = '7c9a1a80b6ff89b6f62b4bd2d096e692dc81b357137d1e4539f65820bcb0d3c3baf5b2bdf084573f1d586d1b3e36063324636735c56a3ab5223bae268a6e1387';

        $paymentType = $request->payment_method;

        $paymentGatewayUrl = 'https://demo.bookeey.com/portal/bookeey/MerchantRegistration';

        $moreDtl = array(
            array(
            "paymentType" => $paymentType,
            "from" => "0",
            "to" => "500",
            "fixed" => "0.3",
            "isLower" => false,
            "percentage" => "3",
            "bookeeyCommission" => "0.15"
            )
        );


        $postParams['mid'] = $mid;
        $postParams['merchantName'] = $name;
        $postParams['emailAddress'] = $email;
        $postParams['phoneAddress'] = $phone;
        $postParams['ISDNCode'] = $phone_code;
        $postParams['merchantIBanNo'] = $merchantIBanNo;
        $postParams['accountTitleName'] = $bank_name;
        $postParams['swiftCode'] = $swift_code;
        $postParams['hashMac'] = $hash_code;
        $postParams['TransactionFees'] = $moreDtl;

        $ch = curl_init();

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );

        // dd(json_encode($postParams));


        curl_setopt($ch, CURLOPT_URL, $paymentGatewayUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postParams));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $serverOutput = curl_exec($ch);
        $decodeOutput = json_decode($serverOutput, true);

        curl_close($ch);

        // dd($decodeOutput, $postParams, $serverOutput, $decodeOutput['g_status']);

        if($decodeOutput['g_status_description'] == 'Success')
        {
            $transactionDetails = $decodeOutput['subMerchantId'];
            // dd($subMerchantId);

            $this->initiatePayment($transactionDetails, $paymentType, $hash_code, $mid, $price, $invitation_uuid);

        }

        // if (isset($decodeOutput['PayUrl'])) {
        //     if ($decodeOutput['PayUrl'] == '') {
        //         echo "Error Message: " . $decodeOutput['ErrorMessage'];
        //     } else {
        //         header("Location: " . $decodeOutput['PayUrl']);
        //     }
        // } else if (isset($decodeOutput['Message'])) {
        //     echo "Error Message: " . $decodeOutput['Message'];
        // } else {
        //     echo "Error<br>";
        //     print_r($decodeOutput);
        // }


    }


    protected function hashFunction($email, $phone_number)
    {
        $mid = 'mer2100054';
        $email =  $email;
        $phone = $phone_number;
        $crossCat = 'GEN';
        $secretKey = '6042256';

        $hash = hash('sha512', $mid.'|'. $email . '|'. $phone . '|'. $crossCat . '|'. $secretKey);
        return $hash;
    }



    protected function initiatePayment($transactionDetails, $paymentType, $hash_code, $mid, $price, $invitation_uuid)
    {
        // dd('ok');
        session_start();
        $sessionId = session_id();
        $systemInfo = $this->systemInfo();
        $browser = $this->browser();
        $payerName = "test";
        $payerPhone = "03024505726";
        // $mid = "mer2000032";
        $tex = $random_pwd = mt_rand(1000000000000000, 9999999999999999);
        $txnRefNo = $tex;
        // $fu = "https://demo.bookeey.com/portal/paymentfailure";
        // $su = "https://demo.bookeey.com/portal/paymentSuccess";
        // $fu = "http://localhost/football/payment/failure/$invitation_uuid/";
        // $su = "http://localhost/football/payment/success/$invitation_uuid/";

        $fu = route('payment', ['failure', $invitation_uuid]);
        $su = route('payment', ['success', $invitation_uuid]);

        $amt = 50;
        // $amt = $amount;
        $orderId = mt_rand(1000000000000000, 9999999999999999);
        // $txnTime = "1545633631518";
        // $txnTime = date("ymdHis");
        $rndnum = rand(10000, 99999);
        $crossCat = "GEN";
        $secretKey = 6042256;
        $defaultPaymentOption = "Bookeey";
        $selectedPaymentOption = $paymentType;
        $paymentoptions = ($selectedPaymentOption == '') ? $defaultPaymentOption : $selectedPaymentOption;
        $data = "$mid|$txnRefNo|$su|$fu|$amt|$crossCat|$secretKey|$rndnum";
        $hashed = hash('sha512', $data);

        // dd($paymentoptions);

        $paymentGatewayUrl = "https://apps.bookeey.com/pgapi/api/payment/requestLink";

        // $txnDtl = $transactionDetails;
        $txnDtl = array(
            array(
                'SubMerchUID' => $transactionDetails,
                // 'Txn_AMT' => '10'
                'Txn_AMT' => $price
            )
        );

        $txnHdr = array(
            "PayFor" => "ECom",
            "Txn_HDR" => $rndnum,
            "PayMethod" => $paymentoptions,
            "BKY_Txn_UID" => "",
            "Merch_Txn_UID" => $orderId,
            "hashMac" => $hash_code
        );

        $appInfo = array(
            "APPTyp" => "",
            "OS" => $systemInfo['os'] . ' - ' . $browser,
            "DevcType" => $systemInfo['device'],
            "IPAddrs" => $_SERVER['SERVER_ADDR'],
            "Country" => "",
            "AppVer" => "2.0.0",
            "UsrSessID" => $sessionId,
            "APIVer" => "2.0.0"
        );

        $pyrDtl = array(
            "Pyr_MPhone" => $payerPhone,
            "Pyr_Name" => $payerName
        );

        $merchDtl = array(
            "BKY_PRDENUM" => "ECom",
            "FURL" => $fu,
            "MerchUID" => $mid,
            "SURL" => $su
        );

        $moreDtl = array(
            "Cust_Data1" => "test",
            // "Cust_Data3" => "",
            // "Cust_Data2" => ""
        );

        $postParams['Do_TxnDtl'] = $txnDtl;
        $postParams['Do_TxnHdr'] = $txnHdr;
        $postParams['Do_Appinfo'] = $appInfo;
        $postParams['Do_PyrDtl'] = $pyrDtl;
        $postParams['Do_MerchDtl'] = $merchDtl;
        $postParams['DBRqst'] = "PY_ECom";
        $postParams['Do_MoreDtl'] = $moreDtl;

        $ch = curl_init();

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );

        // dd(json_encode($postParams));

        curl_setopt($ch, CURLOPT_URL, $paymentGatewayUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postParams));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $serverOutput = curl_exec($ch);
        $decodeOutput = json_decode($serverOutput, true);
        curl_close($ch);

        // dd($decodeOutput, $serverOutput);

        if (isset($decodeOutput['PayUrl'])) {
            if ($decodeOutput['PayUrl'] == '') {
            // dd($decodeOutput['Message'], "abcsdadasdas");

                return redirect()->back()->with("Error Message: " , $decodeOutput['ErrorMessage']);

            } else {
                $url = $decodeOutput['PayUrl'];
                // dd($url);
            // dd($decodeOutput, "123123asdasdas");

               return redirect()->to($url)->send();

            }
        } else if (isset($decodeOutput['Message'])) {
            // dd($decodeOutput['Message'], "12312312312");
            return redirect()->back()->with("Error Message: " , $decodeOutput['Message']);

        } else {
            // echo "Error<br>";
            // return print_r($decodeOutput);
            // dd($decodeOutput['Message'], "zyzxyczy12312312");

            return redirect()->back()->with("Error Message: ", $decodeOutput);

        }
    }



    /**
     * Get System information
     */
    protected function systemInfo()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform    = "Unknown OS Platform";
        $os_array       = array(
            '/windows nt 10.0/i'    =>  'Windows 10',
            '/windows phone 8/i'    =>  'Windows Phone 8',
            '/windows phone os 7/i' =>  'Windows Phone 7',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        $found = false;
        $device = '';

        foreach ($os_array as $regex => $value) {
            if ($found)
                break;
            else if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
                $device = !preg_match('/(windows|mac|linux|ubuntu)/i', $os_platform)
                    ? 'MOBILE' : (preg_match('/phone/i', $os_platform) ? 'MOBILE' : 'SYSTEM');
            }
        }
        $device = !$device ? 'SYSTEM' : $device;

        return array('os' => $os_platform, 'device' => $device);
    }


    /**
     * Get Browser information
     */
    protected function browser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser        =   "Unknown Browser";
        $browser_array  = array(
            '/msie/i'       =>  'Internet Explorer',
            '/firefox/i'    =>  'Mozilla Firefox',
            '/safari/i'     =>  'Safari',
            '/chrome/i'     =>  'Google Chrome',
            '/edge/i'       =>  'Microsoft Edge',
            '/opera/i'      =>  'Opera',
            '/netscape/i'   =>  'Netscape',
            '/maxthon/i'    =>  'Maxthon',
            '/konqueror/i'  =>  'Konqueror',
            '/mobile/i'     =>  'Handheld Browser'
        );

        $found = false;

        foreach ($browser_array as $regex => $value) {
            if ($found)
                break;
            else if (preg_match($regex, $user_agent, $result)) {
                $browser = $value;
            }
        }

        return $browser;
    }

}

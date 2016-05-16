<?php




class AppUserMSISDN extends Eloquent
{
    protected $table = 'app_user_msisdns';


    public static function addMsisdns($userID, $msisdn)
    {

        $authCode=mt_rand(0,1000000);

        if(count(AppUser::find($userID))==0):
            $response = array('success' => false, 'error' =>'Invalid user id');
            return \Response::json($response,422);
        elseif(count(AppUserMSISDN::where('app_user_id','<>',$userID)->where('msisdn',$msisdn)->get())>0):

            $response = array('success' => false, 'error' =>'This msisdn used by another user');
            return \Response::json($response,422);

        elseif(count($result=AppUserMSISDN::where('app_user_id',$userID)->where('msisdn',$msisdn)->get())>0):

            $appUserMsisdn = AppUserMSISDN::find($result[0]['id']);
            $appUserMsisdn->auth_code =$authCode ;
            $appUserMsisdn->save();
            $response['data'] = array('success' => true, 'auth_code' => $authCode);
            AppUserMSISDN::sendAuthCodeToMobile($msisdn,$authCode);
            return \Response::json($response);
        endif;
        $appUserMsisdn = new AppUserMSISDN();
        $appUserMsisdn->app_user_id = $userID;
        $appUserMsisdn->auth_code =$authCode ;
        $appUserMsisdn->msisdn = $msisdn;
        $appUserMsisdn->is_active = '0';
        if ($appUserMsisdn->save()):
            AppUserMSISDN::sendAuthCodeToMobile($msisdn,$authCode);
            $response['data'] = array('success' => true, 'auth_code' => $authCode);
            return \Response::json($response);
        else:
            return false;
        endif;
    }


    public static function resendUserMsisdn($userID, $msisdn)
    {

        $authCode=mt_rand(0,1000000);

        if(count(AppUser::find($userID))==0):
            $response = array('success' => false, 'error' =>'Invalid user id');
            return \Response::json($response,422);
        elseif(count(AppUserMSISDN::where('app_user_id','<>',$userID)->where('msisdn',$msisdn)->get())>0):

            $response = array('success' => false, 'error' =>'This msisdn used by another user');
            return \Response::json($response,422);

        elseif(count($result=AppUserMSISDN::where('app_user_id',$userID)->where('msisdn',$msisdn)->get())>0):

            $appUserMsisdn = AppUserMSISDN::find($result[0]['id']);
            $appUserMsisdn->auth_code =$authCode ;
            $appUserMsisdn->save();
            $response['data'] = array('success' => true, 'auth_code' => $authCode);
            AppUserMSISDN::sendAuthCodeToMobile($msisdn,$authCode);
            return \Response::json($response);
        endif;
        $response = array('success' => false, 'error' =>'msisdn not found');
        return \Response::json($response,422);
    }


    public  static  function validateMsisdns($userID,$msisdn,$authCode)
    {

       $result= AppUserMSISDN::where('app_user_id',$userID)
                     ->where('msisdn',$msisdn)
                     ->where('auth_code',$authCode)
                    ->get();

        if(count($result)>0):
            $appMsisdn=AppUserMSISDN::find($result[0]['id']);
            $appMsisdn->is_active=1;
            if($appMsisdn->save()):
                return true;
            endif;
        else:
                 return false;
       endif;
    }

    public static function deactivateUserMsisdn($userID,$msisdn)
    {
        $result= AppUserMSISDN::where('app_user_id',$userID)
            ->where('app_user_id',$userID)
            ->where('msisdn',$msisdn)
            ->get();

        if(count($result)>0):
            if($result[0]['is_active']=='0'):
                return $response = array('data'=>array('success' => false, 'error' => 'Already deactivated'),'code'=>'422');
            endif;
            $appMsisdn=AppUserMSISDN::find($result[0]['id']);
            $appMsisdn->is_active=0;
            if($appMsisdn->save()):
                return $response =array('data'=>array('success' => true),'code'=>'200');
            endif;
        else:
                return $response = array('data'=>array('success' => false, 'error' => 'Invalid Credentials'),'code'=>'422');
        endif;
    }


    public  static  function getMsisdn($userID){
        $result= AppUserMSISDN::where('app_user_id',$userID)
            ->where('is_active',1)
            ->select('msisdn')
            ->get();
        return $result;
    }




    public  static function sendAuthCodeToMobile($msisdn, $authCode)
    {

        include app_path().'/libraries/DialogAPI/'.'IdeaBizAPIHandler.php';

        $auth = new IdeaBizAPIHandler();
        $msisdn = str_replace('94', 'tel:+94', str_replace('+', '', $msisdn));

        $args['outboundSMSMessageRequest'] = array(
            "address" =>
                array($msisdn),
            "senderAddress" =>
                "tel:87733",
            "clientCorrelator" => "",
            "outboundSMSTextMessage" =>
                array("message" => "" . 'Your Verification Code is ' . $authCode . ""),
            "receiptRequest" =>
                array('notifyURL' => ' ', "callbackData" => ' '),
            "senderName" => ""
        );


        $url = "https://ideabiz.lk/apicall/smsmessaging/v2/outbound/87733/requests";

        $a = $auth->sendAPICall($url, RequestMethod::POST, json_encode($args));
        return true;

    }






}
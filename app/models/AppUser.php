<?php

class AppUser extends Eloquent
{
    protected $table = 'app_users';
    public static $secretKey = 'turingm#^&o3+vhdzw@j8$klf26y6_osuij1^yav0$$u@48s2-pofzf5app';

    public static $rules = [
        'password' => 'required',
        'device_id' => 'required',
        'name' => 'required',
        'email' => 'required|email'
    ];


    public static function registerAppUser($name, $email, $password, $deviceID, $msisdn, $uploadedPic)
    {
        $appUser = new AppUser();
        $appUser->name = $name;
        $appUser->email = $email;
        $appUser->password = base64_encode(hash_hmac('sha256', $password, AppUser::$secretKey, false));
        $appUser->device_id = $deviceID;
        $appUser->type = 'APP';
        $appUser->pro_pic = $uploadedPic;
        $appUser->created_at = time();
        $appUser->is_active = 1;
        $userID = null;

        if ($appUser->save()):
            $userID = $appUser->id;
            return $userID;
        else:
            return false;
        endif;
    }


    public static function updateAppUser ($userID,$name,$email,$uploadedPic)
    {

        $appUser=AppUser::find($userID);
        if ($appUser):
            if ($name!=''):
            $appUser->name = $name;
            endif;
            if ($email!=''):
                $appUser->email = $email;
            endif;
            if ($uploadedPic!=''):
                File::delete(public_path().$appUser->pro_pic);
            $appUser->pro_pic = $uploadedPic;
            endif;
            if ($name!=''||$email!=''||$uploadedPic!=''):
            if ($appUser->save()):
                return $response =array('data'=>array('success' => true),'code'=>'200');
            endif;
            endif;
        endif;
           return $response = array('data'=>array('success' => false, 'error' => 'Invalid user id'),'code'=>'422');
    }

    public static function activateUser($userID)
    {
        $result= AppUser::where('id',$userID)
                          ->get();
        if(count($result)>0):
            if($result[0]['is_active']=='1'):
                return $response = array('data'=>array('success' => false, 'error' => 'Already activated'),'code'=>'422');
            endif;
            $appUser=AppUser::find($userID);
            $appUser->is_active=1;
            if($appUser->save()):
                return $response =array('data'=>array('success' => true),'code'=>'200');
            endif;
        else:
                return $response = array('data'=>array('success' => false, 'error' => 'Invalid user id'),'code'=>'422');
        endif;
    }

    public static function deactivateUser($userID)
    {
        $result= AppUser::where('id',$userID)
                          ->get();
        if(count($result)>0):
            if($result[0]['is_active']=='0'):
                return $response = array('data'=>array('success' => false, 'error' => 'Already deactivated'),'code'=>'422');
            endif;
            $appUser=AppUser::find($userID);
            $appUser->is_active=0;
            if($appUser->save()):
                return $response =array('data'=>array('success' => true),'code'=>'200');
            endif;
        else:
                return $response = array('data'=>array('success' => false, 'error' => 'Invalid User'),'code'=>'422');
        endif;
    }

    public static function forgotPassword($email)
    {

        $result= AppUser::where('email',$email)
                        ->where('is_active',1)
                        ->where('type','APP')
                        ->get();
        if(count($result)>0):
            $passwordToHash=mt_rand(0,100000000);
            $appUser=AppUser::find($result[0]['id']);
            $newPassword= base64_encode(hash_hmac('sha256',$passwordToHash, AppUser::$secretKey, false));
            $appUser->password=$newPassword;
            if($appUser->save()):
                Mail::send('emails.auth.forgot_password', ['newPassword' => $passwordToHash,'receivername'=>$result[0]['name'] ], function($message) use ($appUser)
                {
                    $message
                        ->to($appUser->email, $appUser->name)
                        ->subject("Password Reset Request");
                });
                return $response =array('data'=>array('success' => true),'code'=>'200');
            endif;
        else:
                return $response = array('data'=>array('success' => false, 'error' => 'Invalid User'),'code'=>'422');
        endif;
    }

    public static  function  sendMail($payload)
    {
        if ($payload['cc'] != '') {
            Mail::send('emails.auth.support_cc_template', ['payload' =>$payload], function($message) use ($payload) {
                $message
                    ->cc($payload['cc'])
                    ->subject('Support Request');
                    if($payload['file_path'] != ''){
                        $message
                            ->to($payload['to'])
                            ->cc($payload['cc'])
                            ->subject('Support Request')
                            ->attach($payload['file_path']);
                    }
            });
            Mail::send('emails.auth.support_template', ['payload' =>$payload], function($message) use ($payload) {
                $message
                    ->to($payload['to'])
                    ->subject('Support Request');
                if($payload['file_path'] != ''){
                    $message
                        ->to($payload['to'])
                        ->subject('Support Request')
                        ->attach($payload['file_path']);
                }
            });

            }else{
            Mail::send('emails.auth.support_template', ['payload' =>$payload], function($message) use ($payload) {
                $message
                    ->to($payload['to'])
                    ->subject('Support Request');
                    if($payload['file_path'] != ''){
                        $message
                            ->to($payload['to'])
                            ->subject('Support Request')
                            ->attach($payload['file_path']);
                    }
            });
            }

    }

    public static function changePassword($userID,$oldPassword,$newPassword)
    {

        $result= AppUser::where('id',$userID)
                        ->where('is_active',1)
                        ->where('type','APP')
                        ->get();
        if(count($result)>0):
            if(base64_encode(hash_hmac('sha256',$oldPassword, AppUser::$secretKey, false))!=$result[0]['password']):
                return $response = array('data'=>array('success' => false, 'error' => 'Old password is incorrect'),'code'=>'422');
            endif;
            $appUser=AppUser::find($userID);
            $appUser->password=base64_encode(hash_hmac('sha256',$newPassword, AppUser::$secretKey, false));
            if($appUser->save()):
                return $response =array('data'=>array('success' => true),'code'=>'200');
            endif;
        else:
                return $response = array('data'=>array('success' => false, 'error' => 'Invalid User'),'code'=>'422');
        endif;

    }

    public static function userLogin($email, $password)
    {

        $encryptedPass = base64_encode(hash_hmac('sha256', $password, AppUser::$secretKey, false));
        $login = AppUser::where('email', $email)
            ->where('password', $encryptedPass)
            ->where('type', 'APP')
            ->where('is_active', 1)
            ->get();

        return $login;
    }

    public static function fbLogin($fbID, $name, $email, $deviceID)
    {


        $fbLogin = AppUser::where('fb_id', $fbID)
            ->where('type', 'FB')
            ->where('is_active', 1)
            ->get();

        if (!count($fbLogin) > 0):

            $appUser = new AppUser();
            $appUser->name = $name;
            $appUser->email = $email;
            $appUser->fb_id = $fbID;
            $appUser->device_id = $deviceID;
            $appUser->type = 'FB';
            $appUser->created_at = time();
            $appUser->is_active = 1;

            $appUser->save();
            $userID = $appUser->id;

            $fbLogin = AppUser::where('fb_id', $fbID)
                ->where('type', 'FB')
                ->where('is_active', 1)
                ->where('id', $userID)
                ->get();
        endif;

        return $fbLogin;
    }

}
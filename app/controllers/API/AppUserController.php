<?php
namespace Api;
use APIController;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Dialog\Utils\ImageUploader;

class AppUserController extends APIController
{
    protected $upload;

    public function __construct(ImageUploader $upload)
    {

        $this->upload = $upload;
    }


    public function registerAppUser()
    {

        $name = Input::get('name');
        $email = Input::get('email');
        $password = Input::get('password');
        $deviceID = Input::get('device_id');
        $msisdn = Input::get('msisdn');
        $proPic = Input::file('pro_pic');
        $uploadedPic = null;


        $validation = Validator::make(Input::all(), \AppUser::$rules);
        if (!$validation->passes()):
            $response = array('success' => false, 'error' => $validation->messages());
            return \Response::json($response, 422);
        endif;


        $uploadedPic='';
            if(!empty($_FILES['pro_pic'])) :
                $uploadedPic = $this->upload->doUpload($proPic, 'app/app_users');
            endif;

        $userID = \AppUser::registerAppUser($name, $email, $password, $deviceID, $msisdn, $uploadedPic);
        if (is_int($userID)):
            $response = array('success' => true,'user_id'=>$userID,'access_token' => '123455');
            return \Response::json($response);
        else:
        endif;


    }



    public function signUpAppUser()
    {

        $name = Input::get('name');
        $email = Input::get('email');
        $password = Input::get('password');
        $deviceID = Input::get('device_id');
        $msisdn = Input::get('msisdn');
        $proPic = Input::file('pro_pic');
        $uploadedPic = null;


        $validation = Validator::make(Input::all(), \AppUser::$rules);
        if (!$validation->passes()):
            $response = array('success' => false, 'error' => $validation->messages());
            return \Response::json($response, 422);
        endif;


        $activatedEmail=\AppUser::where('email',$email)->where('is_active',1)->first();

        if($activatedEmail){
            $response = array('success' => false, 'error' =>array('email'=>array('This email already activated')));
            return \Response::json($response, 422);
        }


        $uploadedPic='';
        if(!empty($_FILES['pro_pic'])) :
            $uploadedPic = $this->upload->doUpload($proPic, 'app/app_users');
        endif;

        $userID = \AppUser::registerAppUser($name, $email, $password, $deviceID, $msisdn, $uploadedPic);
        if (is_int($userID)):
            $response = array('success' => true,'user_id'=>$userID,'access_token' => '123455');
            return \Response::json($response);
        else:
        endif;


    }


    public function updateAppUser()
    {

        $userID = Input::get('user_id');
        $name = Input::get('name');
        $email = Input::get('email');
        $proPic = Input::file('pro_pic');
        $uploadedPic = null;
        $userLogin=\AppUser::findOrFail($userID);

        $uploadedPic='';
        if(!empty($_FILES['pro_pic'])) :
            $uploadedPic = $this->upload->doUpload($proPic, 'app/app_users');
        endif;

           \AppUser::updateAppUser($userID,
                                            $name,
                                            $email,
                                            $uploadedPic
                                            );
        if (count($userLogin) > 0):
            if(!empty($_FILES['pro_pic'])) :
                $uploadedPic='http://providers.droaming.arimaclanka.com'.$uploadedPic;
            else:

                $uploadedPic=strlen($userLogin->pro_pic)>10?'http://providers.droaming.arimaclanka.com'.$userLogin->pro_pic:"";
            endif;
            $response['data'] = array(
                'user_id' => $userLogin->id,
                'name' => $userLogin->name,
                'email' => $userLogin->email,
                'pro_pic' =>$uploadedPic,
                'msisdn' =>\AppUserMSISDN::getMsisdn($userLogin->id),
                'access_token' => '123455');

            return \Response::json($response);
         endif;

           // return \Response::json($response['data'],$response['code']);
    }

    function activateUser()
    {
        $userID = Input::get('user_id');
        $response=\AppUser::activateUser($userID);
        return \Response::json($response['data'],$response['code']);
    }

    function deactivateUser()
    {
        $userID = Input::get('user_id');
        $response=\AppUser::deactivateUser($userID);
        return \Response::json($response['data'],$response['code']);
    }


    function userLogin()
    {
       $email = Input::get('email');
        $password = Input::get('password');
        $userLogin = \AppUser::userLogin($email, $password);

        if (count($userLogin) > 0):

            $response['data'] = array(
                                        'user_id' => $userLogin[0]['id'],
                                        'name' => $userLogin[0]['name'],
                                        'email' => $userLogin[0]['email'],
                                        'pro_pic' =>isset($userLogin[0]['pro_pic'])?asset('/public').$userLogin[0]['pro_pic']:'',
                                        'msisdn' =>\AppUserMSISDN::getMsisdn($userLogin[0]['id']),
                                        'access_token' => '123455');
            return \Response::json($response);

        else:
            $response = array('success' => false, 'error' => 'Login Failed');
            return \Response::json($response, 422);

        endif;
    }

    function fbLogin()
    {

        $fbID = Input::get('fb_id');
        $name = Input::get('name');
        $email = Input::get('email');
        $deviceID = Input::get('device_id');
        $userLogin = \AppUser::fbLogin($fbID,$name, $email, $deviceID);


        $response['data'] = array(
            'user_id' => $userLogin[0]['id'],
            'name' => $userLogin[0]['name'],
            'email' => $userLogin[0]['email'],
            'msisdn' =>\AppUserMSISDN::getMsisdn($userLogin[0]['id']),
            'access_token' => '123455');
        return \Response::json($response);


    }

    function forgotPassword()
    {
        $email = Input::get('email');
        $response = \AppUser::forgotPassword($email);
        return \Response::json($response['data'],$response['code']);
    }

    function  sendMail()
    {

        $payload=array();
        $payload['to'] = Input::get('mail_to');
        $payload['cc'] = Input::get('mail_cc');
        $payload['user_name'] = Input::get('user_name');
        $payload['contact'] = Input::get('contact_number');
        $payload['subject'] = Input::get('subject');
        $payload['comment'] = Input::get('comment');
        $payload['file_path'] = Input::get('file_path');
        $response = \AppUser::sendMail($payload);


                return \Response::json(['data'=>array('success' => true)],200);

    }

    function changePassword()
    {
        $userID = Input::get('user_id');
        $oldPassword = Input::get('old_password');
        $newPassword = Input::get('new_password');
        $response = \AppUser::changePassword($userID,$oldPassword,$newPassword);
        return \Response::json($response['data'],$response['code']);
    }

    function addUserMsisdn()
    {

        $userID = Input::get('user_id');
        $msisdn = Input::get('msisdn');
        return \AppUserMSISDN::addMsisdns($userID,$msisdn);

    }

    function resendUserMsisdn()
    {

        $userID = Input::get('user_id');
        $msisdn = Input::get('msisdn');
        return \AppUserMSISDN::resendUserMsisdn($userID,$msisdn);

    }

    function validateUserMsisdn()
    {
        $userID = Input::get('user_id');
        $msisdn = Input::get('msisdn');
        $authCode = Input::get('auth_code');

        $validate=\AppUserMSISDN::validateMsisdns($userID,$msisdn,$authCode);
        if($validate):
            $response['data']['success']=true;
            $response['data']['msisdn']=\AppUserMSISDN::getMsisdn($userID);
            return \Response::json($response);
         else:
             $response = array('success' => false, 'error' => 'Invalid Credentials');
             return \Response::json($response, 422);
        endif;
    }


    function deactivateUserMsisdn()
    {
        $userID = Input::get('user_id');
        $msisdn = Input::get('msisdn');
        $response=\AppUserMSISDN::deactivateUserMsisdn($userID,$msisdn);
            return \Response::json($response['data'],$response['code']);
    }
}
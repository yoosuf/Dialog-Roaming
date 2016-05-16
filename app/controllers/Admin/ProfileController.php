<?php
/**
 * Created by PhpStorm.
 * User: yoosuf
 * Date: 11/10/2015
 * Time: 15:00
 */

namespace Admin;


use AdminController;
use Country;
use Dialog\Utils\ImageUploader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Partner;
use ServiceProvider;

use User;



class ProfileController  extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */

    protected $userModel;

    protected $spModel;

    protected $partner;

    /**
     * ProfileController constructor.
     * @param User $userModel
     * @param ServiceProvider $spModel
     * @param Partner $partner
     * @param ImageUploader $upload
     */
    public function __construct(User $userModel, ServiceProvider $spModel, Partner $partner , ImageUploader $upload)
    {

        $this->userModel = $userModel;

        $this->spModel = $spModel;

        $this->partner = $partner;

        $this->upload = $upload;
    }


    /**
     * @param $invitation_code
     * @return mixed
     */
    public function setupAccount($invitation_code = null) {


        if (is_null($invitation_code)) App::abort(404);

        $user = $this->userModel->where('invitation_code', '=', $invitation_code)->first();

        if ($user) {

            return View::make('auth.account.password.setup')->with('invitation_code', $invitation_code);
        }

        return Redirect::route('login')->with('message', 'There are some issues, Please try again with the forgot password option.');
    }


    /**
     * @param $invitation_code
     * @return mixed
     */
    public function setupPassword($invitation_code) {

        $rules = array(
            'password' => 'required|alphaNum|between:6,16|confirmed'
        );

        $validation = Validator::make(Input::all(), $rules);

        $user = $this->userModel->where('invitation_code', '=', $invitation_code)->first();

        if ($validation->passes()) {

            $user->password = Input::get('password');
            $user->save();

            return Redirect::route('login')->with('success', 'You have successfully updated your password.');
        }

        return Redirect::route('auth.account.password.setup', $user->invitation_code)
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');

    }





    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function profile()
    {

        if ( $this->currentUser()->role_id === 2) {

            $id = $this->currentOrg()->id;

            $data = $this->spModel->find($id);

            $countries = Country::lists('country_name', 'id');

            if (is_null($data))
            {
                return Redirect::route('service-providers.profile');
            }

            return View::make('admin.service-providers.edit', compact('data', 'countries'));


        } else if ( $this->currentUser()->role_id === 3) {

            $id = $this->currentPartner()->id;

            $data = $this->partner->find($id);

            if (is_null($data))
            {
                return Redirect::route('partners.profile');
            }

            return View::make('admin.partners.edit', compact('data'));

        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update()
    {

        if ($this->currentUser()->role_id === 2) {

            $id = $this->currentOrg()->id;

            $input = array_except(Input::all(), '_method');

            $rules = [
                'sp_code' => 'required',
                'sp_name' => 'required',
                'mcc' => 'required',
                'mnc' => 'required',
                'splash_screen_logo' => 'image',
                'splash_screen_text' => 'required',
                'main_screen_logo' => 'image',
                'main_screen_text' => 'required',
                'contact_telephone' => 'required',
                'contact_email' => 'required|email',
                'website_url' => 'required|url',
                'country_id' => 'required',
            ];

            $validation = Validator::make($input, $rules);

            if ($validation->passes()) {
                $data = $this->spModel->find($id);


                if (Input::hasFile('splash_screen_logo')) {

                    $input['splash_screen_logo'] = $this->upload->doUpload(Input::file('splash_screen_logo'), 'service-providers');

                } else {

                    $input['splash_screen_logo'] = $data->splash_screen_logo;
                }


                if (Input::hasFile('main_screen_logo')) {

                    $input['main_screen_logo'] = $this->upload->doUpload(Input::file('main_screen_logo'), 'service-providers');

                } else {

                    $input['main_screen_logo'] = $data->main_screen_logo;
                }


                if (Input::hasFile('about_banner_img')) {

                    $input['about_banner_img'] = $this->upload->doUpload(Input::file('about_banner_img'), 'service-providers');

                } else {

                    $input['about_banner_img'] = $data->about_banner_img;
                }


                $data->update($input);

                return Redirect::route('profile')->with('message', 'Profile is updated.');
            }

            return Redirect::route('profile')
                ->withInput()
                ->withErrors($validation)
                ->with('message', 'There were validation errors.');

        } else if ( $this->currentUser()->role_id === 3) {

            $id = $this->currentPartner()->id;

            $input = array_except(Input::all(), '_method');

            $validation = Validator::make($input, Partner::$rules);

            if ($validation->passes())
            {
                $data = $this->partner->find($id);
                $data->update($input);

                return Redirect::route('profile');
            }

            return Redirect::route('profile')
                ->withInput()
                ->withErrors($validation)
                ->with('message', 'There were validation errors.');

        }
    }





    public function changePassword() {

        return View::make('auth.account.password.change');

    }




    public function updatePassword() {

        $user = Auth::user();
        $rules = array(
            'current_password' => 'required',
            'password' => 'required|between:6,16|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('password')
                ->withErrors($validator)
                ->with('message', 'There were validation errors.');
        } else {
            if (!Hash::check(Input::get('current_password'), $user->password)) {
                return Redirect::route('account.password')->with("message", "Your old password does not match");
            } else {
                $user->password = Input::get('password');
                $user->save();
                return Redirect::route('password')->with("message", "Password have been changed");
            }
        }

    }



}
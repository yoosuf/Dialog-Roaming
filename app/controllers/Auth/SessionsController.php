<?php


namespace Auth;

use BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;


class SessionsController extends BaseController
{


    public function login()
    {
        if (Auth::check()) {
            return Redirect::to('dashboard');
        }

        return View::make('auth.login');

    }


    public function doLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required|min:6'
        ];


        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'))
                ->with('message', 'There were validation errors.');

        } else {

            $input = [
                'username' => Input::get('username'),
                'password' => Input::get('password')
            ];


            if (Auth::attempt($input)) {

                if(Auth::user()->is_active == 1) {
                    return Redirect::to('dashboard');
                } else {

                    Auth::logout();
                    return Redirect::to('login')->with('message', 'The account is not active, please contact the administrator.');
                }

            } else {

                return Redirect::to('login')->with('message', 'There were validation errors.');

            }

        }

    }


    public function doLogout()
    {

        Auth::logout();

        return Redirect::to('login')->with('message', 'Successfully logged out.');
    }

}
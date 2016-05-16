<?php
/**
 * Created by PhpStorm.
 * User: yoosuf
 * Date: 06/10/2015
 * Time: 15:33
 */

namespace Auth;


use BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class AccountsController extends BaseController
{



    public function InitialAccountPasswordSetup() {

        if(Auth::check()){
            return Redirect::route('account.profile');
        }
        return View::make('auth.account.password.setup');


    }



    public function InitialAccountSetup() {

        if($this->currentUser()->initial_login) {

            return View::make('auth.account.setup');

        }
        return Redirect::route('dashboard');
    }
}
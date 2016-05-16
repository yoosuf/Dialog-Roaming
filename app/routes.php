<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function () {
    return Redirect::route('login');
});


Route::get('login', ['as' => 'login', 'uses' => 'Auth\SessionsController@login']);

Route::post('login', ['as' => 'session.create', 'uses' => 'Auth\SessionsController@doLogin']);

Route::get('forgot', ['as' => 'forgot', 'uses' => 'Auth\RemindersController@getRemind']);

Route::post('forgot', ['as' => 'forgot.trigger', 'uses' => 'Auth\RemindersController@postRemind']);

Route::get('account/reset/{token}', ['as' => 'reset', 'uses' => 'Auth\RemindersController@getReset']);

Route::post('account/reset', ['as' => 'reset.trigger', 'uses' => 'Auth\RemindersController@postReset']);

Route::get('account/setup/{invitation_code}', ['as' => 'setup', 'uses' => 'Admin\ProfileController@setupAccount']);

Route::post('account/setup', ['as' => 'setup.trigger', 'uses' => 'Admin\ProfileController@setupPassword']);

Route::group(array('before' => 'auth'), function () {

    Route::get('logout', 'Auth\SessionsController@doLogout');

    Route::get('dashboard', 'AdminController@dashboard');

    Route::resource('roles', 'Admin\RolesController');

    Route::resource('users', 'Admin\UsersController');

    Route::post('users/reset/{id}', ['as' => 'users.reset', 'uses' => 'Admin\UsersController@sendResetPasswordInstructionsToUser']);

    Route::resource('advertisements', 'Admin\AdvertisementsController');

    Route::resource('roaming-tips', 'Admin\RoamingTipsController');

    Route::resource('help-managements', 'Admin\HelpManagementsController');

    Route::resource('approved-partners', 'Admin\ApprovedPartnersController');

    Route::resource('home-menus', 'Admin\HomeMenusController');

    Route::resource('home-sub-menus', 'Admin\HomeSubMenusController');

    Route::resource('countries', 'Admin\CountriesController');

    Route::resource('support-managements', 'Admin\SupportManagementController');

    // Partner Services
    Route::resource('service-categories', 'Admin\PartnerServiceCategoriesController');

    Route::resource('partner-services', 'Admin\PartnerServiceSubCategoriesController');


    // nested routes for partners
    Route::resource('partners', 'Admin\PartnersController@index');

    Route::resource('partners.categories', 'Admin\PartnerCategoriesController');

    Route::resource('partners.categories.services', 'Admin\PartnerServicesController');


    Route::resource('mobile-apis', 'Admin\MobileApisController');

    Route::resource('app-menus', 'Admin\AppSiteMenusController');

    Route::resource('service-provider-api', 'Admin\ServiceProviderApiController');

    Route::get('profile', ['as' => 'profile', 'uses' => 'Admin\ProfileController@profile']);

    Route::patch('profile', 'Admin\ProfileController@update');

    Route::get('password', ['as' => 'password', 'uses' => 'Admin\ProfileController@changePassword']);

    Route::post('password', 'Admin\ProfileController@updatePassword');

    /**
     *  This resources should be bind wiuth user roles
     */
    Route::resource('menu-options', 'Admin\MenuOptionsController');

    Route::resource('user-access', 'Admin\UserAccessController');

    Route::post('update-site-menus', 'Admin\AppSiteMenusController@updateCheckbox');


});

//API Routes
Route::group(array('prefix' => 'api/v1'), function () {
    //Service Provider Module
    Route::get('check-updates/{mno_id}/{updated_at}/', 'API\ServiceProvidersController@checkUpdate');
    Route::get('mno-config/{mno_id}/', 'API\ServiceProvidersController@getMNO');
    Route::get('about-us/{service_id}', 'API\ServiceProvidersController@getAboutUs');

    //Help & Support Management
    Route::get('support-mng/{mno_id}/', 'API\SupportManagementController@getSupportMng');
    Route::get('help-mng/{mno_id}/', 'API\HelpManagementController@gethelpMng');

    //Roaming Tips
    Route::get('roaming-tips/{mno_id}/', 'API\RoamingTipController@getRoamingTips');

    //Advertisement
    Route::get('advertisement/{mno_id}/', 'API\AdvertisementController@getAdvertisements');
    Route::get('subscription/{mno_id}/', 'API\SubscriptionController@getSubscriptions');

    //App User Management
    Route::post('user-register', 'API\AppUserController@registerAppUser');
    Route::post('user-signup', 'API\AppUserController@signUpAppUser');
    Route::post('update-user', 'API\AppUserController@updateAppUser');
    Route::post('activate-user', 'API\AppUserController@activateUser');
    Route::post('deactivate-user', 'API\AppUserController@deactivateUser');
    Route::post('user-login', 'API\AppUserController@userLogin');
    Route::post('fb-login', 'API\AppUserController@fbLogin');
    Route::post('forgot-password', 'API\AppUserController@forgotPassword');
    Route::post('change-password', 'API\AppUserController@changePassword');
    Route::post('add-msisdn', 'API\AppUserController@addUserMsisdn');
    Route::post('resend-msisdn', 'API\AppUserController@resendUserMsisdn');
    Route::post('validate-msisdn', 'API\AppUserController@validateUserMsisdn');
    Route::post('deactivate-msisdn', 'API\AppUserController@deactivateUserMsisdn');
    Route::post('send-mail', 'API\AppUserController@sendMail');

    //App Menus
    Route::get('site-navigation/{mno_id}/', 'API\AppSiteMenuController@getSiteMenu');
    Route::get('home-menu/{mno_id}/', 'API\HomeMenuController@getHomeMenu');
    Route::get('home-submenu/{mno_id}/{home_menu_id}', 'API\HomeSubMenuController@getHomeSubMenu');
    Route::get('partner-services/{list_id}/{country_code}', 'API\PartnerServiceController@getPartnerServices');
    Route::get('partner-subservices/{service_id}', 'API\PartnerServiceController@getPartnerServiceSubCategories');
    //Route::get('partner-services/{mno_id}/{sub_menu_id}','API\PartnerServiceController@getPartnerService');

});










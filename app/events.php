<?php
/**
 * Created by PhpStorm.
 * User: yoosuf
 * Date: 14/08/15
 * Time: 16:19
 */


use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

Event::listen('service-provider.create', function($sp) {

    $homeMenus = [
        [   'service_provider_id' => $sp->id,
            'menu_type' => 'explore',
            'title' => 'Explore',
            'banner_img' => '',
            'is_active' => '0',
        ],
        [   'service_provider_id' => $sp->id,
            'menu_type' => 'deals',
            'title' => 'Deals/Offers',
            'banner_img' => '',
            'is_active' => '0',
        ],
        [   'service_provider_id' => $sp->id,
            'menu_type' => 'dine',
            'title' => 'Dine',
            'banner_img' => '',
            'is_active' => '0',
        ],
        [   'service_provider_id' => $sp->id,
            'menu_type' => 'stay',
            'title' => 'Stay/Hotels',
            'banner_img' => '',
            'is_active' => '0',
        ],
        [   'service_provider_id' => $sp->id,
            'menu_type' => 'transport',
            'title' => 'Ground Transport',
            'banner_img' => '',
            'is_active' => '0',
        ],
        [   'service_provider_id' => $sp->id,
            'menu_type' => 'flights',
            'title' => 'Flights',
            'banner_img' => '',
            'is_active' => '0',
        ]
    ];

    DB::table('home_menus')->insert($homeMenus);


    $appMenus = [
        [
            'menu_name' => 'Account info',
            'service_provider_id' =>  $sp->id,
            'is_active' => 0
        ],
        [
            'menu_name' => 'Roaming Rates',
            'service_provider_id' =>  $sp->id,
            'is_active' => 0
        ],
        [
            'menu_name' => 'Roaming Tips',
            'service_provider_id' =>  $sp->id,
            'is_active' => 0
        ],
        [
            'menu_name' => 'Roaming Subscription',
            'service_provider_id' =>  $sp->id,
            'is_active' => 0
        ],
        [
            'menu_name' => 'About Us',
            'service_provider_id' =>  $sp->id,
            'is_active' => 0
        ],
        [
            'menu_name' => 'Support',
            'service_provider_id' =>  $sp->id,
            'is_active' => 0
        ],
        [
            'menu_name' => 'Tutorial',
            'service_provider_id' =>  $sp->id,
            'is_active' => 0
        ],
        [
            'menu_name' => 'Sign Out',
            'service_provider_id' =>  $sp->id,
            'is_active' => 0
        ],
        [
            'menu_name' => 'Subscriptions',
            'service_provider_id' =>  $sp->id,
            'is_active' => 0
        ],

    ];

    DB::table('app_site_menus')->insert($appMenus);


    // And Finally email to the user, he would be happy to see about stuff in his dashboard
    Mail::send('emails.user.welcome', ['user' => $sp ], function($message) use ($sp)
    {

        $message
            ->to($sp->user->email, $sp->user->username)
            ->subject("User Account created");
    });

});



Event::listen('partner.create', function($partner) {

    Mail::send('emails.user.welcome', ['user' => $partner ], function($message) use ($partner)
    {
        $message
            ->to($partner->user->email, $partner->user->username)
            ->subject("User Account created");
    });
});





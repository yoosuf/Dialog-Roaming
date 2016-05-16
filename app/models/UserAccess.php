<?php


class UserAccess extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_access';


    protected $guarded = [];

    public static $rules = [
        'route_name' => 'required',
        'menu_icon' => 'required',
        'show_below' => 'required',
    ];


}
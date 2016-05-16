<?php


class MenuOption extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_options';


    protected $guarded = [];

    public static $rules = [
        'menu_option_id' => 'required',
        'parameters' => 'required',
    ];


}
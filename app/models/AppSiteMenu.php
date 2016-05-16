<?php


class AppSiteMenu extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'app_site_menus';


    public $timestamps = false;

    protected $guarded = [];

    public static $rules = [
        'menu_name' => 'required',
    ];



    /**
     * @return mixed
     */
    public function serviceProvider() {

        return $this->belongsToMany('ServiceProvider');

    }


}
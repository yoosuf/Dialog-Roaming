<?php


class MobileApi extends  Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mobile_apis';

    public $timestamps = false;

    protected $guarded = [];

    public static $rules = [
        'api_name' => 'required',
        'api_version' => 'required',
    ];


//    /**
//     * @return mixed
//     */
//    public function serviceProvider() {
//
//        return $this->belongsToMany('AppSiteMenu');
//
//    }


    public function serviceProviderApi() {

        return $this->hasMany('ServiceProviderApi');

    }
}
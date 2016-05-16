<?php


class Country extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';


    public $timestamps = false;

    protected $guarded = [];

    public static $rules = [
        'country_code' => 'required',
        'country_name' => 'required',
        'country_currency' => 'required',
    ];



    public function partnerServiceCategory() {

        return $this->hasMany('ApprovedPartner');

    }


}
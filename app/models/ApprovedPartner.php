<?php


class ApprovedPartner extends  Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'approved_partners';

    protected $guarded = [];

    public static $rules = [
        'partner_id' => 'required',
        'service_provider_id' => 'required',
    ];





    public function partner() {

        return $this->belongsTo('Partner');

    }


    public function serviceProvider() {

        return $this->belongsTo('ServiceProvider');

    }


}
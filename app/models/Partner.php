<?php


class Partner extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'partners';

    protected $guarded = [];

    public static $rules = [
        'partner_name' => 'required',
    ];



    public function user() {

        return $this->belongsTo('User');

    }


    public function approvedPartner() {

        return $this->hasMany('ApprovedPartner');

    }


    public static function boot()
    {
        parent::boot();

        static::created(function ($partner) {

            Event::fire('partner.create', [$partner]);
        });

    }



}

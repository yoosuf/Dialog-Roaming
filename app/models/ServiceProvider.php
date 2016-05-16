<?php

class ServiceProvider extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_providers';
    protected $guarded = [];

    public static $rules = [
        'sp_name' => 'required',
    ];


    /**
     * @return mixed
     */
    public function user() {

        return $this->belongsTo('User');

    }



    public function ads() {

        return $this->belongsTo('Advertisement');
    }



    public function approvedServiceProvider() {

        return $this->hasMany('ApprovedPartner');

    }



    public function serviceProviderApi() {

        return $this->hasMany('ServiceProviderApi');

    }

//    public function appSiteMenus() {
//
//        return $this->hasMany('ApprovedPartner');
//
//    }
//
//
//
//    public function mobileApi() {
//
//        return $this->belongsToMany('MobileApi');
//
//    }





    public static function boot()
    {
        parent::boot();

        static::created(function ($sp) {

            Event::fire('service-provider.create', [$sp]);
        });

    }








    public static function checkUpdate($mnoID, $lastUpdatedAt)
    {
        $lastUpdatedAt = str_replace("%20", " ", $lastUpdatedAt);
        $hasSPUpdate = ServiceProvider::where('id', $mnoID)->where("updated_at", $lastUpdatedAt)
            ->select('updated_at')
            ->first();
        return $hasSPUpdate;
    }

    public static function getMNO($mnoID)
    {

        $serviceProvider = ServiceProvider::where('id', $mnoID)
                                            ->select('mcc', 'mnc', 'sp_name', 'country_id','contact_telephone', 'splash_screen_logo',
                                                'splash_screen_text', 'main_screen_logo', 'main_screen_text', 'updated_at')
                                            ->first();

        $response = [];
        if (count($serviceProvider) > 0):
            $country = Country::find($serviceProvider->country_id)
                ->select('country_name', 'country_currency')->first();
            $response[] = [
                'mcc' => $serviceProvider->mcc,
                'mnc' => $serviceProvider->mnc,
                'name' => $serviceProvider->sp_name,
                'country' => $country->country_name,
                'hotline' => $serviceProvider->contact_telephone,
                'currency' => $country->country_currency,
                'splash_screen_logo' =>asset('/').$serviceProvider->splash_screen_logo,
                'splash_screen_text' => $serviceProvider->splash_screen_text,
                'main_screen_logo' => asset('/') . $serviceProvider->main_screen_logo,
                'main_screen_text' => $serviceProvider->main_screen_text,
                'updated_at' => $serviceProvider->updated_at->format('Y-m-d H:i:s')
            ];
        endif;
        return $response;
    }

    public static function getAboutUs($mnoID)
    {
        $aboutUs = ServiceProvider::where('id', $mnoID)
            ->select('about_description','about_banner_img')
            ->get();
        $response=[];
        if (count($aboutUs)>0):
            $response['description']=$aboutUs[0]['about_description'];
            $response['image']=asset('/') .$aboutUs[0]['about_banner_img'];
        endif;
        return $response;

    }
}
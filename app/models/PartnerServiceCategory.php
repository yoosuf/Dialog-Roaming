<?php

class PartnerServiceCategory extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'partner_service_categories';

    protected $guarded = [];



    public function country() {

        return $this->belongsTo('Country', 'country_id');

    }


    public static $rules = [
        'service_name' => 'required',
        'banner_img' => 'required|image',
    ];




    public static function getPartnerServices($menuType, $countryCode)
    {
        $partnerServiceCats=DB::table('partner_service_categories AS ptn_cat')
                                ->select('ptn_cat.id AS id','ptn_cat.service_name AS name','ptn_cat.banner_img AS small_image',
                                         'ptn_subcat.banner_img AS large_image','ptn_subcat.contact_number','ptn_subcat.email','ptn_subcat.description','ptn_subcat.website_url')
                               ->join('partner_service_subcategories AS ptn_subcat', 'ptn_cat.id', '=', 'ptn_subcat.partner_service_category_id')
                                ->join('countries AS cnt', 'ptn_cat.country_id','=', 'cnt.id')
                                ->where('cnt.country_code',$countryCode)
                                ->where('ptn_cat.menu_type',$menuType)
                                ->get();
        $response = [];

        if (count($partnerServiceCats) > 0):
            foreach($partnerServiceCats as $partnerServiceCat):
            $response[] = [
                'id' => $partnerServiceCat->id,
                'name' => $partnerServiceCat->name,
                'description'=>$partnerServiceCat->description,
                'small_image' =>asset('/').$partnerServiceCat->small_image,
                'large_image' =>asset('/').$partnerServiceCat->large_image,
                'contact_number'=>$partnerServiceCat->contact_number,
                'email'=>$partnerServiceCat->email,
                'website'=>$partnerServiceCat->website_url
            ];
            endforeach;
        endif;
        return $response;
    }

}

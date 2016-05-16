<?php

class PartnerServiceSubCategory  extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'partner_service_subcategories';

    protected $guarded = [];




    public static function getPartnerServiceSubCategories($serviceID)
    {

        $partnerServices=DB::table('partner_service_categories AS ptn_cat')
                            ->join('partner_service_subcategories AS ptn_subcat', 'ptn_cat.id', '=', 'ptn_subcat.partner_service_category_id')
                            ->where('ptn_subcat.partner_service_category_id',$serviceID)
                            ->select(
                                   'ptn_subcat.id AS ptn_subcat_id','ptn_subcat.service_name as ptn_subcat_name','ptn_subcat.description as ptn_description',
                                    'ptn_subcat.banner_img AS ptn_subcat_image','ptn_subcat.website_url AS ptn_subcat_website_url'
                                    )
                            ->get();

        $response = [];
        foreach($partnerServices as $partnerService):

                $response[]=[
                            'id'=>$partnerService->ptn_subcat_id,
                            'name'=>$partnerService->ptn_subcat_name,
                            'description'=>$partnerService-> ptn_description,
                            'image'=>asset('/').$partnerService-> ptn_subcat_image,
                            'website'=>$partnerService->ptn_subcat_website_url
                            ];
        endforeach;
        return $response;
    }
}
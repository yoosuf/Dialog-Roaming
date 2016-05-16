<?php
class HomeSubMenu extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'home_submenus';
    protected $guarded = [];




    public function menu()
    {
        return $this->belongsTo('HomeMenu', 'home_menu_id');
    }



    public static function getHomeSubMenu($mnoID,$homeMenuID)
    {
        $homeSubMenus = HomeSubMenu::where('service_provider_id',$mnoID)
            ->where('home_menu_id',$homeMenuID)
            ->where('is_active',1)
            ->where('option','website')
            ->get(array('id','title','description','option','external_url','banner_img','option','service_provider_api_id'));
        $response = [];
        foreach ($homeSubMenus as $homeSubMenu):
            $option=$homeSubMenu->option;
            $api_id=$homeSubMenu->service_provider_api_id;
            $api=null;
            if($option=='2'){
                $api=DB::table('service_provider_apis AS sp_api')
                    ->join('mobile_apis AS mob_api', 'sp_api.mobile_api_id', '=', 'mob_api.id')
                    ->where('sp_api.id',$api_id)
                    ->pluck('mob_api.api_name');
            }
            $response[] = [
                'id' => $homeSubMenu->id,
                'title' => $homeSubMenu->title,
                'description' => $homeSubMenu->description,
                'image' => asset('/') . $homeSubMenu->banner_img,
                'option' =>1,
                'api'=>$api,
                'external_url' => $homeSubMenu->external_url
            ];
        endforeach;
        return $response;
    }


}
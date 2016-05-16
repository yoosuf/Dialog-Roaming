<?php
class HomeMenu extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'home_menus';
    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
    ];


    /**
     * @return mixed
     */
    public function subMenus(){

        return $this->hasMany('HomeSubMenu');
    }


    /**
     * @param $mnoID
     * @return array
     */
    public static function getHomeMenu($mnoID)
    {
        $homeMenus = HomeMenu::where('service_provider_id',$mnoID)->where('is_active',1)
                               ->orderBy('list_order')
                               ->get(array('id','title','banner_img','list_order','menu_type'));

        $response = [];

        foreach ($homeMenus as $homeMenu):

            $response[] = [
                'id' => $homeMenu->id,
                'menuType' =>$homeMenu->menu_type,
                'title' => $homeMenu->title,
                'image' => asset('/') . $homeMenu->banner_img,
            ];
        endforeach;
        return $response;
    }

}
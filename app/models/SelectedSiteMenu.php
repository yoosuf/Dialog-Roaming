<?php


class SelectedSiteMenu extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'selected_site_menus';


    public $timestamps = false;

    protected $guarded = [];

    public static $rules = [
        'service_provider_id' => 'required',
        'app_site_menu_id' => 'required',
    ];





    public function menuItem() {

        return $this->belongsTo('AppSiteMenu');

    }


    public function serviceProvider() {

        return $this->belongsTo('ServiceProvider');

    }


    public static  function  getSiteMenu($mnoID){
        $selectedSiteMenu=  DB::table('app_site_menus AS sm')
                            ->join('selected_site_menus AS ssm', 'sm.id', '=', 'ssm.app_site_menu_id')
                            ->where('ssm.service_provider_id',$mnoID)
                            ->select('sm.id','sm.menu_name')
                            ->get();
        return $selectedSiteMenu;
    }

}
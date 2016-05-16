<?php


class SupportManagement extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'support_managements';


    protected $guarded = [];




    public static function getSupportMng($mnoID)
    {
        $supportManagement = SupportManagement::where('service_provider_id',$mnoID)->where('is_active',1)->get(array('subject','email'));
        return $supportManagement;
    }


}
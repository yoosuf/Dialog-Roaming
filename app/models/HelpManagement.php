<?php

class HelpManagement extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'help_managements';
    protected $guarded = [];



    public static function getHelpMng($mnoID)
    {
        $helpManagement = HelpManagement::where('service_provider_id', $mnoID)
                                          ->where('is_active', 1)
                                          ->get(array('subject', 'description'));
        return $helpManagement;
    }

}
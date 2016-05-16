<?php

class RoamingTip extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roaming_tips';
    protected $guarded = [];


    public function users()
    {
        return $this->belongsTo('users');
    }

    public static function getRoamingTips($mnoID, $page, $limit)
    {
        $limit = (int)$limit;
        $page = (int)$page;
        $skip = $limit * ($page - 1);
        $roamingTips = \RoamingTip::where('service_provider_id', $mnoID)
                                    ->take($limit)->skip($skip)
                                    ->get();

        $response = [];
        foreach ($roamingTips as $roamingTip):
            $response[] = [
                'id' => $roamingTip->id,
                'title' => $roamingTip->title,
                'description' => $roamingTip->description,
                'image' => asset('/') . $roamingTip->banner_img
            ];
        endforeach;
        return $response;
    }

    public static function totalTipCount($mnoID)
    {
        $roamingTips = \RoamingTip::where('service_provider_id', $mnoID)
                                    ->select('id')
                                    ->get();
        return count($roamingTips);

    }
}
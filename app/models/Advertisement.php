<?php

class Advertisement extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'advertisements';


    protected $guarded = [];


    /**
     * @return mixed
     */
    public function serviceProvider() {

        return $this->belongsTo('ServiceProvider');

    }



    public static function getAdvertisement($mnoID, $page, $limit)
    {
        $limit = (int)$limit;
        $page = (int)$page;
        $skip = $limit * ($page - 1);

        $advertisements = DB::table('advertisements')->where('type', 'GEN')
                            ->select('id', 'title', 'description', 'banner_img', 'external_uri')
                            ->union(DB::table('advertisements')->where('service_provider_id', $mnoID)->where('type', 'SP')
                            ->select('id', 'title', 'description', 'banner_img AS image', 'external_uri AS ext_url'))
                            ->take($limit)->skip($skip)->get();

        $response = [];
        foreach ($advertisements as $advertisement):

            $response[] = [
                'id' => $advertisement->id,
                'title' => $advertisement->title,
                'description' => $advertisement->description,
                'image' => asset('/') . $advertisement->banner_img,
                'ext_url' => $advertisement->external_uri
            ];
        endforeach;
        return $response;
    }


    public static function totalAdCount($mnoID)
    {

        $advertisements = DB::table('advertisements')->where('type', 'GEN')
                            ->select('id')
                            ->union(DB::table('advertisements')->where('service_provider_id', $mnoID)->where('type', 'SP')
                            ->select('id'))->get();
        return count($advertisements);

    }

    public static function getSubscription($mnoID, $page, $limit)
    {

        $limit = (int)$limit;
        $page = (int)$page;
        $skip = $limit * ($page - 1);
        $subscriptions = Advertisement::where('service_provider_id', $mnoID)->where('type', 'SUB')
                                        ->select('id', 'title', 'description', 'banner_img', 'external_uri')
                                        ->take($limit)->skip($skip)->get();
        $response = [];

        foreach ($subscriptions as $subscription):
            $response[] = [
                'id' => $subscription->id,
                'title' => $subscription->title,
                'description' => $subscription->description,
                'image' => asset('/') . $subscription->banner_img,
                'ext_url' => $subscription->external_uri
            ];
        endforeach;
        return $response;
    }


    public static function totalSubCount($mnoID)
    {
        $subscriptions = Advertisement::where('service_provider_id', $mnoID)->where('type', 'SUB')
            ->select('id')
            ->get();
        return count($subscriptions);

    }


}
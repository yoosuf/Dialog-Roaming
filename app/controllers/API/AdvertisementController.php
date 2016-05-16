<?php
namespace Api;
use APIController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class AdvertisementController extends APIController
{
    /**
     * Gets Advertisements to given Service Provider
     * @param $mnoID
     * @return mixed
     */
    function getAdvertisements($mnoID)
    {
        $page = Input::get('page');
        $limit = Input::get('limit');
        $advertisement = \Advertisement::getAdvertisement($mnoID, $page, $limit);
            if (count($advertisement) > 0):
                $response['data'] = $advertisement;
                $response['paging'] = array(
                                            'page' => $page,
                                            'total' => (string)\Advertisement::totalAdCount($mnoID),
                                            'limit' => $limit
                                            );
                return \Response::json($response);
            else:
                $response = array('success' => false, 'error' => 'Advertisement  Not Found');
                return \Response::json($response, 404);
            endif;
    }
}
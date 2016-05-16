<?php


namespace Api;


use APIController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class RoamingTipController extends APIController
{
    function getRoamingTips($mnoID)
    {

        $page = Input::get('page');
        $limit = Input::get('limit');
        $roamingTip = \RoamingTip::getRoamingTips($mnoID, $page, $limit);
        if (count($roamingTip)>0):

            $response['data'] = $roamingTip;
            $response['paging'] = array(
                'page' => $page,
                'total' => (string)\RoamingTip::totalTipCount($mnoID),
                'limit' => $limit
            );
            return \Response::json($response);


        else:
            $response = array('success' => false, 'error' => 'Roaming Tip  Not Found');
            return \Response::json($response, 404);
        endif;
    }


}
<?php


namespace Api;


use APIController;
use Illuminate\Http\Response;

class SupportManagementController extends APIController
{


    /**
     * Gets the Support Management to given Service Provider
     * @param $mnoID
     * @return mixed
     */
    function getSupportMng($mnoID)
    {

        $supportManagement = \SupportManagement::getSupportMng($mnoID);
        if (count($supportManagement)>0):
            $response['data'] = $supportManagement;
            return \Response::json($response);

        else:
            $response = array('success' => false, 'error' => 'Support Management  Not Found');
            return \Response::json($response,404);
        endif;
    }


}

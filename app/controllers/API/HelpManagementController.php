<?php
namespace Api;
use APIController;
use Illuminate\Http\Response;

class HelpManagementController extends APIController
{
    /**
     * Gets the Help Management to given Service Provider
     * @param $mnoID
     * @return mixed
     */
    function gethelpMng($mnoID)
    {
        $helpManagement =\HelpManagement::getHelpMng($mnoID);
        if (count($helpManagement)>0):
            $response['data'] = $helpManagement;
            return \Response::json($response);
        else:
            $response = array('success' => false, 'error' => 'Help Management  Not Found');
            return \Response::json($response,404);
        endif;
    }
}
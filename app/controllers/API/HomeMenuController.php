<?php
namespace Api;
use APIController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class HomeMenuController extends APIController
{
    /**
     * Gets the HomeMenu to given Service Provider
     * @param $mnoID
     * @return mixed
     */
    function getHomeMenu($mnoID)
    {
        $homeMenu = \HomeMenu::getHomeMenu($mnoID);
        if (count($homeMenu) > 0):
            $response['data'] = $homeMenu;
            return \Response::json($response);

        else:
            $response = array('success' => false, 'error' => 'Home Menus Not Found');
            return \Response::json($response, 404);
        endif;
    }

}
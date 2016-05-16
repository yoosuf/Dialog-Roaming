<?php
namespace Api;
use APIController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class HomeSubMenuController extends APIController
{
    /**
     * Gets the HomeSubMenu to given Service Provider
     * @param $mnoID
     * @param $homeMenuID
     * @return mixed
     */
    function getHomeSubMenu($mnoID,$homeMenuID)
    {

        $homeSubMenu = \HomeSubMenu::getHomeSubMenu($mnoID,$homeMenuID);
        if (count($homeSubMenu)>0):
            $response['data'] = $homeSubMenu;
            return \Response::json($response);

        else:
            $response = array('success' => false, 'error' => 'Home SubMenus Not Found');
            return \Response::json($response, 404);
        endif;
    }
}
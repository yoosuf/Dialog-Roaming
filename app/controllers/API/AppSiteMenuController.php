<?php
namespace Api;
use APIController;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Dialog\Utils\ImageUploader;

class AppSiteMenuController extends APIController
{
    public function getSiteMenu($mnoID)
    {

        $appSiteMenu =\SelectedSiteMenu::getSiteMenu(1);
        if ($appSiteMenu):
            $response['data'] = $appSiteMenu;
            return \Response::json($response);
        else:
            $response = array('success' => false, 'error' => 'Site Navigation Not Found');
            return \Response::json($response,404);
        endif;

    }
}
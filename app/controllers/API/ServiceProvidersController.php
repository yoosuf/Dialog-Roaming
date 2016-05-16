<?php


namespace Api;


use APIController;
use Illuminate\Http\Response;


class ServiceProvidersController extends APIController
{


    /**
     * //Check updates of Service Provider Profile & Mobile Site menu
     * @param $mnoID
     * @param $lastUpdatedAt
     * @return $this
     */
    function checkUpdate($mnoID, $lastUpdatedAt)
    {
        if (!\ServiceProvider::find($mnoID)):
            $response = array('success' => false, 'error' => 'MNO  Not Found');
            return \Response::json($response, 404);
        else:
            $hasUpdates = \ServiceProvider::checkUpdate($mnoID, $lastUpdatedAt);

            if ($hasUpdates):
                $responseArg['main'] = false;
                $responseArg['sitemap'] = false;
            else:
                $responseArg['main'] = true;
                $responseArg['sitemap'] = false;
            endif;
        endif;

        $response['data'] = $responseArg;
        return \Response::json($response);
    }


    function  getMNO($mnoID)
    {
        $serviceProvider = \ServiceProvider::getMNO($mnoID);
        if ($serviceProvider):
            $response['data'] = $serviceProvider;
            return \Response::json($response);
        else:
            $response = array('success' => false, 'error' => 'MNO  Not Found');
            return \Response::json($response, 404);
        endif;
    }

    function  getAboutUs($mnoID)
    {
        $aboutUs = \ServiceProvider::getAboutUs($mnoID);
        if (count($aboutUs)>0):
            $response['data'] = $aboutUs;
            return \Response::json($response);
        else:
            $response = array('success' => false, 'error' => 'About Us  Not Found');
            return \Response::json($response, 404);
        endif;
    }
}
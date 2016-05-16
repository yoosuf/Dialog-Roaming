<?php
namespace Api;
use APIController;
use Illuminate\Http\Response;
class PartnerServiceController extends APIController
{

    function getPartnerService($mnoID, $subMenuID)
    {
        $partnerServices = \PartnerServiceSubCategory::getPartnerService($mnoID, $subMenuID);
        if (count($partnerServices) > 0):
            $response['data'] = $partnerServices;
            return \Response::json($response);
        else:
            $response = array('success' => false, 'error' => 'Partner Service  Not Found');
            return \Response::json($response, 404);
        endif;
    }



    function getPartnerServices($homeID, $countryCode)
    {
        $partnerServices = \PartnerServiceCategory::getPartnerServices($homeID, $countryCode);
        if (count($partnerServices) > 0):
            $response['data'] = $partnerServices;
            return \Response::json($response);
        else:
            $response = array('success' => false, 'error' => 'Partner Service Categories  Not Found');
            return \Response::json($response, 404);
        endif;
    }

    function  getPartnerServiceSubCategories($serviceID)
    {
        $partnerServices = \PartnerServiceSubCategory:: getPartnerServiceSubCategories($serviceID);

        if (count($partnerServices) > 0):
            $response['data'] = $partnerServices;
            return \Response::json($response);
        else:
            $response = array('success' => false, 'error' => 'Partner Service Sub Categories  Not Found');
            return \Response::json($response, 404);
        endif;
    }
}
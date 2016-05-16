<?php
namespace Api;
use APIController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class SubscriptionController  extends APIController
{
    /**
     * Gets the Subscriptions to given Service Provider
     * @param $mnoID
     * @return mixed
     */
    function getSubscriptions($mnoID)
    {
        $page = Input::get('page');
        $limit = Input::get('limit');
        $subscriotion = \Advertisement::getSubscription($mnoID, $page, $limit);
        if (count($subscriotion)>0):
            $response['data'] = $subscriotion;
            $response['paging'] = array(
                'page' => $page,
                'total' => (string)\Advertisement::totalSubCount($mnoID),
                'limit' => $limit
            );
            return \Response::json($response);
        else:
            $response = array('success' => false, 'error' => 'Subscription  Not Found');
            return \Response::json($response, 404);
        endif;
    }
}
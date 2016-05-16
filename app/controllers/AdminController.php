<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    protected $currentUser;
    protected $currentOrg;
    protected $currentPartner;


    public function __construct()
    {
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }


    /**
     * @return mixed
     */
    protected function currentUser()
    {
        $this->currentUser = Auth::user();

        return $this->currentUser;
    }


    /**
     * @return mixed
     */
    protected function currentOrg()
    {
        $this->currentOrg = ServiceProvider::where('user_id', '=', $this->currentUser()->id)->first();

        return $this->currentOrg;
    }


    /**
     * @return mixed
     */
    protected function currentPartner()
    {
        $this->currentOrg = Partner::where('user_id', '=', $this->currentUser()->id)->first();

        return $this->currentOrg;
    }


    public function dashboard()
    {
        return View::make('admin.dashboard.index');
    }
}
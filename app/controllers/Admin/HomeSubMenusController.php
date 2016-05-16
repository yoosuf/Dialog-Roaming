<?php
/**
 * Created by PhpStorm.
 * User: yoosuf
 * Date: 04/10/2015
 * Time: 17:26
 */

namespace Admin;


use AdminController;
use Dialog\Utils\ImageUploader;
use HomeMenu;
use HomeSubMenu;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Partner;
use ServiceProvider;


class HomeSubMenusController extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    public function __construct(HomeSubMenu $model, ImageUploader $upload)
    {
        $this->upload = $upload;

        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = $this->model->where('service_provider_id', '=', $this->currentOrg()->id)->get();

        return View::make('admin.home-sub-menus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $homeMenuList = HomeMenu::where('service_provider_id', '=', $this->currentOrg()->id)->lists('title', 'id');

        $providerApiList = "";

        $partnerList = Partner::where('service_provider_id', '=', $this->currentOrg()->id)->lists('partner_name', 'id');


        return View::make('admin.home-sub-menus.create', compact('serviceProviders', 'homeMenuList', 'providerApiList', 'partnerList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $rules = [

            'title' => 'required',
            'description' => 'required',
            'option'=> 'required',
            'banner_img' => 'required|image',
            'external_url' => 'url|required_if:option,website',
            'service_provider_api_id' => 'required_if:option,api',
            'partner_service_id' => 'required_if:option,partner'
        ];


        $input = Input::all();
        $input['service_provider_id'] = $this->currentOrg()->id;


        if(Input::has('external_url')) {

            $input['external_url'] = Input::get('external_url');

        }

        if(Input::has('service_provider_api_id')) {

            $input['service_provider_api_id'] = Input::get('service_provider_api_id');
        }

        if(Input::has('partner_service_id')) {

            $input['partner_service_id'] = Input::get('partner_service_id');

        }


        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {
            if (Input::file('banner_img')) {
                $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'home-submenus');
            }

            $this->model->create($input);

            return Redirect::route('home-sub-menus.index');
        }

        return Redirect::route('home-sub-menus.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
//        $data = $this->model->findOrFail($id);

//        return View::make('admin.home-sub-menus.show', compact('data'));

        return Redirect::route('home-sub-menus.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->model->find($id);

        $homeMenu = HomeMenu::where('service_provider_id', '=', $this->currentOrg()->id)->lists('title', 'id');


        if (is_null($data)) {
            return Redirect::route('home-sub-menus.index');
        }

        return View::make('admin.home-sub-menus.edit', compact('data', 'homeMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $rules = [
            'title' => 'required',
            'banner_img' => 'image',
            'external_url' => 'url'
        ];

        $input = array_except(Input::all(), '_method');
        $input['is_active'] = Input::get('is_active', 0);



        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {


            $data = $this->model->find($id);


            if (Input::hasFile('banner_img')) {

                $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'home-submenus');

            } else {

                $input['banner_img'] = $data->banner_img;
            }


            $data->update($input);

            return Redirect::route('home-sub-menus.index')->with('message', 'Updated.');
        }

        return Redirect::route('home-sub-menus.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->model->find($id)->delete();

        return Redirect::route('home-sub-menus.index');
    }

}
<?php

namespace Admin;


use AdminController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use MobileApi;
use ServiceProvider;
use ServiceProviderApi;


class ServiceProviderApiController extends AdminController
{


    /**
     * role Repository
     *
     * @var
     */
    protected $model;

    public function __construct(ServiceProviderApi $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $serviceProviders = ServiceProvider::lists('sp_name', 'id');

        $data = $this->model->all();

        return View::make('admin.service-provider-api.index', compact('data', 'serviceProviders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $serviceProviders = ServiceProvider::lists('sp_name', 'id');

        $apiProviders = MobileApi::lists('api_name', 'id');

        return View::make('admin.service-provider-api.create', compact('serviceProviders', 'apiProviders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, ServiceProviderApi::$rules);

        if ($validation->passes())
        {
            $this->model->create($input);

            return Redirect::route('service-provider-api.index');
        }

        return Redirect::route('service-provider-api.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
//        $data = $this->model->findOrFail($id);

//        return View::make('admin.roles.show', compact('data'));
        return Redirect::route('service-provider-api.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->model->find($id);

        $partners = ServiceProvider::lists('sp_name', 'id');

        $providers = MobileApi::lists('api_name', 'id');

        if (is_null($data))
        {
            return Redirect::route('service-provider-api.index');
        }

        return View::make('admin.service-provider-api.edit', compact('data', 'partners', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $input['is_active'] = Input::get('is_active', 0);

        $rules = [
            'service_provider_id' => 'required',
            'mobile_api_id' => 'required'
        ];


        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $data = $this->model->find($id);
            $data->update($input);

            return Redirect::route('service-provider-api.index');
        }

        return Redirect::route('service-provider-api.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->model->find($id)->delete();

        return Redirect::route('service-provider-api.index');
    }

}
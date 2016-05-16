<?php
/**
 * Created by PhpStorm.
 * User: yoosuf
 * Date: 03/10/2015
 * Time: 08:31
 */

namespace Admin;


use AdminController;
use Advertisement;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

use Dialog\Utils\ImageUploader;
use ServiceProvider;
use SupportManagement;


class SupportManagementController extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    protected $upload;

    public function __construct(SupportManagement $model, ImageUploader $upload)
    {
        $this->model = $model;

        $this->upload = $upload;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if($this->currentUser()->role_id === 1) {
            $data = $this->model->paginate('20');
        } else {
            $data = $this->model->where('service_provider_id', '=', $this->currentOrg()->id)->paginate('20');
        }

        return View::make('admin.support-managements.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        if($this->currentUser()->role_id === 1) {

            $serviceProviders = ServiceProvider::lists('sp_name', 'id');

        }

        return View::make('admin.support-managements.create', compact('serviceProviders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {


        $rules = [
            'subject' => 'required',
            'email' => 'required|email',
        ];


        $input = Input::all();



            $input['service_provider_id'] = $this->currentOrg()->id;


        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $this->model->create($input);

            return Redirect::route('support-managements.index');
        }

        return Redirect::route('support-managements.create')
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

        return Redirect::route('support-managements.index');
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

        if($this->currentUser()->role_id === 1) {

            $serviceProviders = ServiceProvider::lists('sp_name', 'id');

        }

        if (is_null($data))
        {
            return Redirect::route('support-managements.index');
        }

        return View::make('admin.support-managements.edit', compact('data', 'serviceProviders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {


        $rules = [
            'subject' => 'required',
            'email' => 'required|email',
        ];


        $input = array_except(Input::all(), '_method');

        $input['is_active'] = Input::get('is_active', 0);

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {

            $data = $this->model->find($id);
            $data->update($input);

            return Redirect::route('support-managements.index')->with('message', 'Updated.');
        }

        return Redirect::route('support-managements.edit', $id)
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

        return Redirect::route('support-managements.index');
    }

}
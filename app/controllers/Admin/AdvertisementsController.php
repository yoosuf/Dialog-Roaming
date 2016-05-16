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
use ServiceProvider;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

use Dialog\Utils\ImageUploader;


class AdvertisementsController extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    protected $upload;

    public function __construct(Advertisement $model, ImageUploader $upload)
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
        if ($this->currentUser()->role_id === 1) {
            $data = $this->model->paginate('20');
        } else {
            $data = $this->model->where('service_provider_id', '=', $this->currentOrg()->id)->paginate('20');
        }


        return View::make('admin.advertisements.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        if ($this->currentUser()->role_id === 1) {

            $serviceProviders = ServiceProvider::lists('sp_name', 'id');

        }

        return View::make('admin.advertisements.create', compact('serviceProviders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $rules = [
            'type' => 'required',
            'title' => 'required',
            'banner_img' => 'required|image',
            'external_uri' => 'url'
        ];

        $input = Input::all();

        if ($this->currentUser()->role_id != 1) {
            $input['service_provider_id'] = $this->currentOrg()->id;
        }


        $validation = Validator::make($input, $rules);


        if ($validation->passes()) {
            $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'ads');

            $this->model->create($input);

            return Redirect::route('advertisements.index')->with('message', 'Updated.');
        }

        return Redirect::route('advertisements.create')
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
//        $ad = $this->model->findOrFail($id);

//        return View::make('admin.advertisements.show', compact('ad'));
        return Redirect::route('advertisements.index');
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

        if (is_null($data)) {
            return Redirect::route('advertisements.index');
        }

        return View::make('admin.advertisements.edit', compact('data'));
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
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'banner_img' => 'image',
            'external_uri' => 'url'
        ];

        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {
            $data = $this->model->find($id);


            if (Input::hasFile('banner_img')) {

                $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'ads');

            } else {

                $input['banner_img'] = $data->banner_img;
            }


            $data->update($input);

            return Redirect::route('advertisements.edit', $id)
                ->with('message', 'Updated.');;
        }

        return Redirect::route('advertisements.edit', $id)
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

        return Redirect::route('advertisements.index');
    }

}
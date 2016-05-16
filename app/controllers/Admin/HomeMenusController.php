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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use ServiceProvider;


class HomeMenusController extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    protected $upload;

    public function __construct(HomeMenu $model, ImageUploader $upload)
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
        if ($this->currentUser()->role_id == 1) {
            $data = $this->model->paginate('20');
        } else {
            $data = $this->model->where('service_provider_id', '=', $this->currentOrg()->id)->get();
        }

        return View::make('admin.home-menus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

//        if ($this->currentUser()->role_id === 1) {
//
//            $serviceProviders = ServiceProvider::lists('sp_name', 'id');
//
//        }
//
//        return View::make('admin.home-menus.create', compact('serviceProviders'));

        return Redirect::route('home-menus.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        if ( ! $this->currentUser()->role_id === 1) {

            $input['service_provider_id'] = $this->currentOrg()->id;
        }

        $validation = Validator::make($input, HomeMenu::$rules);

        if ($validation->passes()) {
            $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'home-menus');

            $this->model->create($input);

            return Redirect::route('home-menus.index');
        }

        return Redirect::route('home-menus.create')
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

//        return View::make('admin.home-menus.show', compact('data'));

        return Redirect::route('home-menus.index');
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
            return Redirect::route('home-menus.index');
        }

        return View::make('admin.home-menus.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');

        $rules = [
            'title' => 'required',
            'banner_img' => 'image'

        ];
        $input['is_active'] = Input::get('is_active', 0);


        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {


            $data = $this->model->find($id);


            if (Input::hasFile('banner_img')) {

                $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'home-menus');

            } else {

                $input['banner_img'] = $data->banner_img;
            }

            $data->update($input);

            return Redirect::route('home-menus.index')->with('message', 'Updated.');
        }

        return Redirect::route('home-menus.edit', $id)
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

        return Redirect::route('home-menus.index');
    }

}
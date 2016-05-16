<?php
/**
 * Created by PhpStorm.
 * User: yoosuf
 * Date: 03/10/2015
 * Time: 17:25
 */

namespace Admin;


use AdminController;
use Country;
use Dialog\Utils\ImageUploader;
use Partner;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use PartnerServiceCategory;


class PartnerServiceCategoriesController extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    protected $upload;

    /**
     * PartnerServiceCategoriesController constructor.
     * @param PartnerServiceCategory $model
     * @param ImageUploader $upload
     */
    public function __construct(PartnerServiceCategory $model, ImageUploader $upload)
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

            $data = $this->model->get();

        } else {

            $data = $this->model->where('partner_id', '=', $this->currentPartner()->id)->get();
        }


        return View::make('admin.service-categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {



        if($this->currentUser()->role_id === 1) {
            $partners = Partner::lists('partner_name', 'id');
        }
        $countries = Country::lists('country_name', 'id');

        return View::make('admin.service-categories.create', compact('partners','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {


        $rules = [
            'service_name' => 'required',
            'banner_img' => 'required|image',
        ];

        $input = Input::all();


        $input['partner_id'] = $this->currentPartner()->id;


        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'partners');

            $this->model->create($input);

            return Redirect::route('service-categories.index');
        }

        return Redirect::route('service-categories.create')
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

//        return View::make('admin.service-categories.show', compact('data'));

        return Redirect::route('service-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $countries = Country::lists('country_name', 'id');


        $data = $this->model->find($id);

        if (is_null($data))
        {
            return Redirect::route('service-categories.index');
        }



        return View::make('admin.service-categories.edit', compact('data', 'countries'));
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
            'service_name' => 'required',
            'banner_img' => 'image',
        ];

        $input = array_except(Input::all(), '_method');

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $data = $this->model->find($id);

            if(Input::hasFile('banner_img')) {

                $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'partners');

            } else {

                $input['banner_img'] = $data->banner_img;
            }



            $data->update($input);

            return Redirect::route('service-categories.index')->with('message', 'Updated.');

        }

        return Redirect::route('service-categories.edit', $id)
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

        return Redirect::route('service-categories.index');
    }

}
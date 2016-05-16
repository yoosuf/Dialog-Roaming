<?php
/**
 * Created by PhpStorm.
 * User: yoosuf
 * Date: 03/10/2015
 * Time: 17:25
 */

namespace Admin;


use AdminController;
use Dialog\Utils\ImageUploader;
use Partner;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use PartnerServiceCategory;
use PartnerServiceSubCategory;


class PartnerServiceSubCategoriesController extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    public function __construct(PartnerServiceSubCategory $model, ImageUploader $upload)
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

        if($this->currentUser()->role_id == 1) {
            $data = $this->model->get();
        } else {
            $data = $this->model->where('partner_id', '=', $this->currentPartner()->id)->get();
        }

        return View::make('admin.partner-services.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if($this->currentUser()->role_id === 1) {

            $partnerServiceCategories = PartnerServiceCategory::lists('service_name', 'id');
        } else {

            $partnerServiceCategories = PartnerServiceCategory::where('partner_id', '=', $this->currentPartner()->id)->lists('service_name', 'id');
        }

        return View::make('admin.partner-services.create', compact('partnerServiceCategories'));
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
            'description' => 'required',
            'banner_img' => 'required|image',
            'website_url' => 'url',
            'email' => 'email',
        ];


        $input = Input::all();

        $input['partner_id'] = $this->currentPartner()->id;

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'partners');

            $this->model->create($input);

            return Redirect::route('partner-services.index');
        }

        return Redirect::route('partner-services.create')
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

//        return View::make('admin.partner-services.show', compact('data'));
        return Redirect::route('partner-services.index');
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

            $partnerServiceCategories = PartnerServiceCategory::lists('service_name', 'id');
        } else {

            $partnerServiceCategories = PartnerServiceCategory::where('partner_id', '=', $this->currentPartner()->id)->lists('service_name', 'id');
        }


        if (is_null($data))
        {
            return Redirect::route('partner-services.index');
        }



        return View::make('admin.partner-services.edit', compact('data', 'partnerServiceCategories'));
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
            'description' => 'required',
            'banner_img' => 'image',
            'website_url' => 'required|url',
            'contact_number' => 'required',
            'email' => 'email',
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

            return Redirect::route('partner-services.index')->with('message', 'Updated.');

        }

        return Redirect::route('partner-services.edit', $id)
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

        return Redirect::route('partner-services.index');
    }

}
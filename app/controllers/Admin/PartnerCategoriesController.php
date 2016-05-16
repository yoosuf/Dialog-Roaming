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


class PartnerCategoriesController extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    protected $upload;

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
    public function index($partnerId)
    {

        $data = $this->model->where('partner_id', '=', $partnerId)->get();

        return View::make('admin.service-categories.index', compact('data'))->with("partnerId", $partnerId);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($partnerId)
    {
        $countries = Country::lists('country_name', 'id');

        $partner = Partner::findOrFail($partnerId);

        return View::make('admin.service-categories.create', compact('partners','countries'))
            ->with('partner', $partner);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($partnerId)
    {


        $rules = [
            'service_name' => 'required',
            'banner_img' => 'required|image',
            'country_id' => 'required'
        ];

        $input = Input::all();

        $input['partner_id'] = $partnerId;

        $validation = Validator::make($input, $rules);

        $partner = Partner::findOrFail($partnerId);

        if ($validation->passes())
        {
            $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'partners');

            $this->model->create($input);

            return Redirect::route('partners.categories.index', $partnerId);
        }

        return Redirect::route('partners.categories.create', $partnerId)
            ->withInput()
            ->withErrors($validation)
            ->with('partner', $partner)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($partnerId, $id)
    {
        return Redirect::route('partners.categories.index', $partnerId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($partnerId, $id)
    {

        $countries = Country::lists('country_name', 'id');

        $partner = Partner::findOrFail($partnerId);


        $data = $this->model->where('partner_id', '=', $partnerId)->where('id','=',$id)->first();

        if (is_null($data))
        {
            return Redirect::route('partners.categories.index', $partnerId);
        }



        return View::make('admin.service-categories.edit', compact('data', 'countries'))
            ->with('partner', $partner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($partnerId, $id)
    {
        $rules = [
            'service_name' => 'required',
            'banner_img' => 'image',
        ];

        $input = array_except(Input::all(), '_method');

        $validation = Validator::make($input, $rules);

        $partner = Partner::findOrFail($partnerId);


        if ($validation->passes())
        {
            $data = $this->model->find($id);

            if(Input::hasFile('banner_img')) {

                $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'partners');

            } else {

                $input['banner_img'] = $data->banner_img;
            }



            $data->update($input);

            return Redirect::route('partners.categories.index', $partnerId)->with('message', 'Updated.');

        }

        return Redirect::route('partners.categories.edit', $partnerId, $id)
            ->withInput()
            ->withErrors($validation)
            ->with('partner', $partner)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($partnerId, $id)
    {
        $this->model->find($id)->delete();

        return Redirect::route('partners.categories.index', $partnerId);
    }

}
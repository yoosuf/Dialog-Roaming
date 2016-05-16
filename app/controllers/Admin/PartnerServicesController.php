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
use PartnerServiceSubCategory;


class PartnerServicesController extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    protected $upload;

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
    public function index($partnerId, $categoryId)
    {

        $data = $this->model
            ->where('partner_id', '=', $partnerId)
            ->where('partner_service_category_id', '=', $categoryId)
            ->get();

        $partner = Partner::findOrFail($partnerId);

        $category = PartnerServiceCategory::findOrFail($categoryId);

        return View::make('admin.partner-services.index', compact('data', 'partner',  'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($partnerId, $categoryId)
    {

        $partner = Partner::findOrFail($partnerId);

        $category = PartnerServiceCategory::findOrFail($categoryId);

        $countries = Country::lists('country_name', 'id');

        $partnerServiceCategories = PartnerServiceCategory::where('partner_id', '=', $partnerId)->lists('service_name', 'id');


        return View::make('admin.partner-services.create', compact('partner','countries', 'category', 'partnerServiceCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($partnerId, $categoryId)
    {
        $rules = [
            'service_name' => 'required',
            'banner_img' => 'required|image',
        ];

        $input = Input::all();

        $input['partner_id'] = $partnerId;


        $partner = Partner::findOrFail($partnerId);

        $category = PartnerServiceCategory::findOrFail($categoryId);


        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'partners');

            $this->model->create($input);

            return Redirect::route('partners.categories.services.index', [$partner->id, $category->id]);
        }

        return Redirect::route('partners.categories.services.create', [$partner->id, $category->id])
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
    public function edit($partnerId, $categoryId, $id)
    {

        $countries = Country::lists('country_name', 'id');


        $partner = Partner::findOrFail($partnerId);

        $category = PartnerServiceCategory::findOrFail($categoryId);
        $partnerServiceCategories = PartnerServiceCategory::where('partner_id', '=', $partnerId)->lists('service_name', 'id');


        $data = $this->model->find($id);

        if (is_null($data))
        {
            return Redirect::route('partners.categories.services.index', compact('partner', 'category'));
        }



        return View::make('admin.partner-services.edit', compact('data', 'countries', 'partner', 'category', 'partnerServiceCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($partnerId, $categoryId, $id)
    {
        $rules = [
            'service_name' => 'required',
            'banner_img' => 'image',
        ];

        $input = array_except(Input::all(), '_method');

        $validation = Validator::make($input, $rules);

        $partner = Partner::findOrFail($partnerId);

        $category = PartnerServiceCategory::findOrFail($categoryId);

        if ($validation->passes())
        {
            $data = $this->model->find($id);

            if(Input::hasFile('banner_img')) {

                $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'partners');

            } else {

                $input['banner_img'] = $data->banner_img;
            }

            $data->update($input);

            return Redirect::route('partners.categories.services.index', [$partnerId, $categoryId])->with('message', 'Updated.');

        }

        return Redirect::route('partners.categories.services.edit', [$partnerId, $categoryId, $id])
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
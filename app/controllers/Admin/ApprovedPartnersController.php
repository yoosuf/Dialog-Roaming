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
use ApprovedPartner;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Partner;
use ServiceProvider;

class ApprovedPartnersController extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    public function __construct(ApprovedPartner $model)
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

        return View::make('admin.approved-partners.index', compact('data', 'serviceProviders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $partners = Partner::lists('partner_name', 'id');

        $providers = ServiceProvider::lists('sp_name', 'id');


        return View::make('admin.approved-partners.create', compact('providers', 'partners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();



        $validation = Validator::make($input, ApprovedPartner::$rules);

        if ($validation->passes())
        {
            $this->model->create($input);

            return Redirect::route('approved-partners.index');
        }

        return Redirect::route('approved-partners.create')
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
        $ad = $this->model->findOrFail($id);

        return View::make('admin.approved-partners.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $partners = Partner::lists('partner_name', 'id');

        $providers = ServiceProvider::lists('sp_name', 'id');

        $data = $this->model->find($id);

        if (is_null($data))
        {
            return Redirect::route('approved-partners.index');
        }

        return View::make('admin.approved-partners.edit', compact('data', 'partners', 'providers'));
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

        $validation = Validator::make($input, ApprovedPartner::$rules);

        if ($validation->passes())
        {
            $data = $this->model->find($id);
            $data->update($input);

            return Redirect::route('approved-partners.index');
        }

        return Redirect::route('approved-partners.edit', $id)
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

        return Redirect::route('approved-partners.index');
    }

}
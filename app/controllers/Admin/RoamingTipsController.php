<?php
/**
 * Created by PhpStorm.
 * User: yoosuf
 * Date: 03/10/2015
 * Time: 17:14
 */

namespace Admin;


use AdminController;
use Dialog\Utils\ImageUploader;
use RoamingTip;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class RoamingTipsController  extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    public function __construct(RoamingTip $model, ImageUploader $upload)
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

        return View::make('admin.roaming-tips.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.roaming-tips.create');
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
            'banner_img' => 'required|image',
        ];


        $input = Input::all();
        $input['service_provider_id'] = $this->currentOrg()->id;
        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {

            if(Input::file('banner_img')) {
                $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'roaming-tips');
            }

            $this->model->create($input);

            return Redirect::route('roaming-tips.index');
        }

        return Redirect::route('roaming-tips.create')
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

//        return View::make('admin.roaming-tips.show', compact('data'));
        return Redirect::route('roaming-tips.index');
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

        if (is_null($data))
        {
            return Redirect::route('roaming-tips.index');
        }

        return View::make('admin.roaming-tips.edit', compact('data'));
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

            'title' => 'required',
            'description' => 'required',
            'banner_img' => 'image',
        ];
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {


            $data = $this->model->find($id);

            if(Input::hasFile('banner_img')) {

                $input['banner_img'] = $this->upload->doUpload(Input::file('banner_img'), 'roaming-tips');

            } else {

                $input['banner_img'] = $data->banner_img;
            }



            $data->update($input);

            return Redirect::route('roaming-tips.index')->with('message', 'Updated.');
        }

        return Redirect::route('roaming-tips.edit', $id)
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

        return Redirect::route('roaming-tips.index');
    }

}
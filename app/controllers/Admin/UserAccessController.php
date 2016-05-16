<?php

namespace Admin;


use AdminController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use MenuOption;
use Role;
use UserAccess;

class UserAccessController extends AdminController
{


    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    public function __construct(UserAccess $model)
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
        $data = $this->model->all();

        return View::make('admin.user-access.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.user-access.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, UserAccess::$rules);

        if ($validation->passes())
        {
            $this->model->create($input);

            return Redirect::route('user-access.index');
        }

        return Redirect::route('user-access.create')
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

//        return View::make('admin.user-access.show', compact('data'));
        return Redirect::route('user-access.index');
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
            return Redirect::route('user-access.index');
        }

        return View::make('admin.user-access.edit', compact('data'));
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
        $validation = Validator::make($input, UserAccess::$rules);

        if ($validation->passes())
        {
            $data = $this->model->find($id);
            $data->update($input);

            return Redirect::route('user-access.index');
        }

        return Redirect::route('user-access.edit', $id)
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

        return Redirect::route('user-access.index');
    }

}
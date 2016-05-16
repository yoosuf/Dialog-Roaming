<?php

namespace Admin;

use AdminController;
use AppSiteMenu;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use SelectedSiteMenu;

class AppSiteMenusController extends AdminController
{

    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    protected $menus;


    public function __construct(AppSiteMenu $model, SelectedSiteMenu $menus)
    {
        $this->model = $model;

        $this->menus = $menus;


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
            $data = $this->model->where('service_provider_id', '=', $this->currentOrg()->id)->get();
        }

        return View::make('admin.app-menus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('admin.app-menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $validation = Validator::make($input, AppSiteMenu::$rules);


        if ($validation->passes()) {
            $this->model->create($input);

            return Redirect::route('app-menus.index');
        }

        return Redirect::route('app-menus.create')
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

//        return View::make('admin.app-menus.show', compact('ad'));
        return Redirect::route('app-menus.index');
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
            return Redirect::route('app-menus.index');
        }

        return View::make('admin.app-menus.edit', compact('data'));
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

        $validation = Validator::make($input, AppSiteMenu::$rules);

        if ($validation->passes()) {
            $data = $this->model->find($id);
            $data->update($input);

            return Redirect::route('app-menus.index');
        }

        return Redirect::route('app-menus.edit', $id)
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

        return Redirect::route('app-menus.index');
    }


    public function updateCheckbox()
    {


        $post_data = Input::get('is_active', 0);

        if (is_array($post_data)) {

            foreach ($post_data as $id => $checkbox) {


                if ( ! empty($checkbox)) {

                    $this->model->find($id)->update(['is_active' => 1]);

                } else {

                    $this->model->find($id)->update(['is_active' => 0]);
                }


            }
        }


        return Redirect::route('app-menus.index')->with('message', 'Updated.');

    }

}
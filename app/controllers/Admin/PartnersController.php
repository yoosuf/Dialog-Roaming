<?php


namespace Admin;


use AdminController;
use Illuminate\Support\Facades\View;
use Partner;

class PartnersController extends AdminController
{
    /**
     * role Repository
     *
     * @var role
     */
    protected $model;

    public function __construct(Partner $model)
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

        return View::make('admin.partners.index', compact('data'));
    }

}
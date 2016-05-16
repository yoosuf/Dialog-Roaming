<?php


namespace Admin;


use AdminController;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Partner;
use Role;
use ServiceProvider;
use User;



class UsersController extends AdminController
{

    /**
     * User Repository
     *
     * @var User
     */
    protected $model;
    protected $serviceProviderModel;
    protected $partnerModel;

    public function __construct(User $model, ServiceProvider $serviceProviderModel, Partner $partnerModel)
    {
        $this->model = $model;

        $this->serviceProviderModel = $serviceProviderModel;

        $this->partnerModel = $partnerModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        if($this->currentUser()->role_id == 1) {

            $data = $this->model->all();

        } else {

            $data = $this->model->where('role_id', '=', 3 )->get();
        }



        return View::make('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {


        if($this->currentUser()->role_id === 1) {

            $roles = Role::where('id', '!=', 1)->lists('name', 'id');

        } else {

            $roles = Role::whereNotIn('id', array(1, 2))->lists('name', 'id');
        }


        return View::make('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $input['creator_id'] = $this->currentUser()->id;


        $rules = [
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'role_id' => 'required',
            'sp_name' => 'required_if:role_id,2',
            'partner_name' => 'required_if:role_id,3',
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {

            $user = $this->model->create($input);

            if(Input::get('role_id') == 2) {

                $input = [
                    'sp_name' => Input::get('sp_name'),
                    'user_id' => $user->id,
                ];

                $this->serviceProviderModel->create($input);

            } else if (Input::get('role_id') == 3) {

                $input = [
                    'partner_name' => Input::get('partner_name'),
                    'user_id' => $user->id
                ];

                $this->partnerModel->create($input);

            }

            return Redirect::route('users.index');
        }

        return Redirect::route('users.create')
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

        return Redirect::route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $roles = Role::lists('name', 'id');

        $data = $this->model->find($id);

        if (is_null($data)) {
            return Redirect::route('users.index');
        }

        return View::make('admin.users.edit', compact('data', 'roles'));
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

        $input['is_active'] = Input::get('is_active', 0);

        $rules = [
            'password' => 'min:6|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {
            $data = $this->model->find($id);
            $data->update($input);

            return Redirect::route('users.index')->with('message', 'Updated.');
        }

        return Redirect::route('users.edit', $id)
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

        return Redirect::route('users.index');
    }




    public function sendResetPasswordInstructionsToUser($id) {

        $data = $this->model->find($id);

        switch ($response = Password::remind(['email' => $data->email]))
        {
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));

            case Password::REMINDER_SENT:
                return Redirect::back()->with('status', Lang::get($response));
        }
    }

}

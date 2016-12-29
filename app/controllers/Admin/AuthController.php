<?php namespace Admin;

    use Illuminate\Routing\Controllers\Controller;
    use View, Input, Redirect,Session,Validator,DB,Mail,File,Request,Response,Route;
    use UserGroups as UserGroupsModel, Members as MembersModel, Admin as AdminModel;
class AuthController extends \BaseController{

    public function index() {
        if (Session::has('user_id')) {
            return Redirect::route('admin.dashboard');
        } else {
            return Redirect::route('admin.auth.login');
        }
    }

    public function login() {
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
            return View::make('admin.auth.login')->with($param);
        } else {
            return View::make('admin.auth.login');
        }
    }

    public function doLogin() {
        $rules = ['username'  => 'required',
            'password'  => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else {
            $name = Input::get('username');
            $password = Input::get('password');
            $user = AdminModel::whereRaw('username = ? and userpassword = md5(?) ', array($name, $password))->get();
            if (count($user) != 0) {
                Session::set('user_id', $user[0]->id);
                return Redirect::route('admin.dashboard');
            } else {
                $alert['msg'] = 'Invalid username and password';
                $alert['type'] = 'danger';
                return Redirect::route('admin.auth.login')->with('alert', $alert);
            }
//            }
        }
    }
    public function register(){
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['userGroup']= UserGroupsModel::WhereRaw(true)->orderBy('group_name','asc')->get();
        return View::make('admin.auth.register')->with($param);
    }
    public function store(){
        /*$rules = [
            'first_name' =>'required',
            'last_name' =>'required',
            'email' => 'required|email|unique:users',
            'password'  => 'required|confirmed',
            'password_confirmation' =>'required',
            'username'=> 'required|unique:users',
            'tnc' =>'required',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $memberList = new MembersModel;
            $password = Input::get('password');
            $memberList->first_name = Input::get('first_name');
            $memberList->last_name = Input::get('last_name');
            $memberList->email = Input::get('email');
            $memberList->userpassword = md5($password);
            $memberList->username = Input::get('username');
            $memberList->userGroupID = Input::get('group');
            $memberList->save();
            $alert['msg'] = 'User has been saved successfully';
            $alert['type'] = 'success';
            return Redirect::route('admin.auth.login')->with('alert', $alert);
        }*/
    }
    public function logout() {
        Session::forget('user_id');
        return Redirect::route('admin.auth.login');
    }
}

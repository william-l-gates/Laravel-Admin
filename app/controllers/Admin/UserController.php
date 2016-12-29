<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,Hash;
use Members as MembersModel, UserGroups as UserGroupsModel;
class UserController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter(function () {
            if (!Session::has('user_id')) {
                return Redirect::route('admin.auth.login');
            }
        });
    }
    public function index() {
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['pageNo'] = 15;
        $param['users'] = MembersModel::all();
        return View::make('admin.user.index')->with($param);
    }
    public function create(){
        $param['pageNo'] = 15;
        $param['userGroup'] = UserGroupsModel::WhereRaw(true)->orderBy('group_name','asc')->get();
        return View::make('admin.user.create')->with($param);
    }
    public function store(){
        if(Input::has('user_id')){
            $rules = [
                'first_name' =>'required',
                'last_name' =>'required',
                'password'  => 'required|confirmed|min:7',
                'password_confirmation' =>'required',
                'email' => 'required|email',
                'username'=> 'required',
            ];
        }else{
            $rules = [
                'first_name' =>'required',
                'last_name' =>'required',
                'email' => 'required|email|unique:users',
                'password'  => 'required|confirmed|min:7',
                'password_confirmation' =>'required',
                'username'=> 'required|unique:users',
            ];
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $token =Input::get('_token');
            if(Input::has('user_id')){
                $userID = Input::get('user_id');
                $memberList = MembersModel::find($userID);

                $password = Input::get('password');
                $memberList->first_name = Input::get('first_name');
                $memberList->last_name = Input::get('last_name');
                $memberList->email = Input::get('email');
                $memberList->password =  Hash::make($password);
                $memberList->remember_token = $token;
                $memberList->username = Input::get('username');
                $memberList->userGroupID = Input::get('userGroupID');
                $memberList->save();
                $alert['msg'] = 'User has been updated successfully';
                $alert['type'] = 'success';
            }else{
                $memberList = new MembersModel;
                $password = Input::get('password');
                $memberList->first_name = Input::get('first_name');
                $memberList->last_name = Input::get('last_name');
                $memberList->email = Input::get('email');
                $memberList->password =  Hash::make($password);
                $memberList->username = Input::get('username');
                $memberList->remember_token = $token;
                $memberList->userGroupID = Input::get('userGroupID');
                $memberList->save();
                $alert['msg'] = 'User has been saved successfully';
                $alert['type'] = 'success';
            }
            return Redirect::route('admin.user')->with('alert', $alert);
        }
    }
    public function edit($id){
        $param['pageNo'] =15;
        $param['user'] = MembersModel::find($id);
        $param['userGroup'] = UserGroupsModel::WhereRaw(true)->orderBy('group_name','asc')->get();
        return View::make('admin.user.edit')->with($param);
    }
    public function suspend($id){
        $channel = MembersModel::find($id);
        if($channel->active == 1) {
            $active = 0;
        }else{
            $active = 1;
        }
        $channel->active = $active;

        $channel->save();
        if($active == 0){
            $alert['msg'] = 'User  has been suspended successfully';
        }else{
            $alert['msg'] = 'User  has been activated successfully';
        }
        $alert['type'] = 'success';
        return Redirect::route('admin.user')->with('alert', $alert);
    }

    public function delete($id){
        try {
            MembersModel::find($id)->delete();
            $alert['msg'] = 'This user has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This user  has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.user')->with('alert', $alert);
    }
}
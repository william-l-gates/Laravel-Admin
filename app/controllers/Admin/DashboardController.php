<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Members as MembersModel,Admin as AdminModel;
class DashboardController extends \BaseController {

    public function __construct() {
        $this->beforeFilter(function(){
            if (!Session::has('user_id')) {
                return Redirect::route('admin.auth.login');
            }
        });
    }

    public function index() {
        $param['pageNo'] = 1;
        return View::make('admin.dashboard.index')->with($param);
    }
    public function profile(){
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['pageNo'] = 111;
        return View::make('admin.dashboard.profile')->with($param);
    }
    public function profilestore(){
        $rules = [  'currentPassword'  => 'required',
            'newPassword'  => 'required',
            'confirmNewPassword' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $id = Session::get('user_id');
            $currentPassword= Input::get('currentPassword');
            $newPassword = Input::get('newPassword');
            $confirmNewPassword = Input::get('confirmNewPassword');
            if($newPassword != $confirmNewPassword) {
                $alert['msg'] = 'Please check again your New Password and Confirm New Password';
                $alert['type'] = 'danger';
            }else{
                $userList = AdminModel::whereRaw('userpassword = md5(?) and id =?', array($currentPassword,$id))->get();
                if(count($userList) >0) {
                    $user = AdminModel::find($id);
                    $user->userpassword=md5($newPassword);
                    $user->save();
                    $alert['msg'] = 'User has been updated successfully';
                    $alert['type'] = 'success';
                }else{
                    $alert['msg'] = 'Your Current Password is incorrect.';
                    $alert['type'] = 'danger';
                }
            }
        }
        return Redirect::route('admin.profile')->with('alert', $alert);
    }
}

<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use JobType  as JobTypeModel;
class JobTypeController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter(function () {
            if (!Session::has('user_id')) {
                return Redirect::route('admin.auth.login');
            }
        });
    }
    public function index(){
        $param['pageNo']= 12;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['jobType'] = JobTypeModel::WhereRaw(true)->orderBy('job_type_name','asc')->get();
        return View::make('admin.jobType.index')->with($param);
    }
}
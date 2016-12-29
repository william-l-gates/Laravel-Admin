<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use JobType  as JobTypeModel, JobTypeRight as JobTypeRightModel;
class JobTypeRightController extends \BaseController
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
        $param['pageNo']= 17;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['jobTypeRight'] = JobTypeRightModel::WhereRaw(true)->orderBy('job_type_right_name','asc')->get();
        return View::make('admin.jobTypeRight.index')->with($param);
    }
    public  function create(){
        $param['pageNo']= 17;
        $param['jobType'] = JobTypeModel::WhereRaw(true)->orderBy('job_type_name','asc')->get();
        return View::make('admin.jobTypeRight.create')->with($param);
    }
    public function store(){
                $rules = [
                    'job_type_id' =>'required',
                    'job_type_right_name' =>'required',
                    'description' => 'required',
                ];

            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }else{
                if(Input::has('job_type_right_id')){
                   $list = JobTypeRightModel::find(Input::get('job_type_right_id'));
                   $list->job_type_id = Input::get('job_type_id');
                   $list->description = Input::get('description');
                   $list->job_type_right_name = Input::get('job_type_right_name');
                   $list->save();
                    $alert['msg'] = 'Job type right has been  updated successfully';
                    $alert['type'] = 'success';
                }else{
                    $list = new JobTypeRightModel;
                    $list->job_type_id = Input::get('job_type_id');
                    $list->description = Input::get('description');
                    $list->job_type_right_name = Input::get('job_type_right_name');
                    $list->save();
                    $alert['msg'] = 'Job type right  has been saved successfully';
                    $alert['type'] = 'success';
                }
                return Redirect::route('admin.jobTypeRight')->with('alert', $alert);
            }
    }
    public function suspend($id){
        $channel = JobTypeRightModel::find($id);
        if($channel->active == 1) {
            $active = 0;
        }else{
            $active = 1;
        }
        $channel->active = $active;

        $channel->save();
        if($active == 0){
            $alert['msg'] = 'Job type right  has been suspended successfully';
        }else{
            $alert['msg'] = 'Job type right  has been activated successfully';
        }
        $alert['type'] = 'success';
        return Redirect::route('admin.jobTypeRight')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 17;
        $param['jobTypeRight'] = jobTypeRightModel::find($id);
        $param['jobType'] = JobTypeModel::WhereRaw(true)->orderBy('job_type_name','right')->get();
        return View::make('admin.jobTypeRight.edit')->with($param);
    }
    public function delete($id){
        try {
            jobTypeRightModel::find($id)->delete();
            $alert['msg'] = 'This job type right has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This job type right  has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.jobTypeRight')->with('alert', $alert);
    }
}
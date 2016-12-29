<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use JobType  as JobTypeModel, JobTypeStatus as JobTypeStatusModel, Channels as ChnnelsModel;
class JobTypeStatusController extends \BaseController
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
        $param['pageNo']= 18;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['jobTypeStatus'] = JobTypeStatusModel::all();
        return View::make('admin.jobTypeStatus.index')->with($param);
    }
    public  function create(){
        $param['pageNo']= 18;
        $param['jobType'] = JobTypeModel::WhereRaw(true)->orderBy('job_type_name','asc')->get();
        $param['channels'] = ChnnelsModel::WhereRaw(true)->orderBy('channel_name','asc')->get();
        return View::make('admin.jobTypeStatus.create')->with($param);
    }
    public function store(){
        $rules = [
            'job_type_id' =>'required',
            'channel_id' =>'required',
            'status_name' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
				if(Input::get('start_status') == 1){
							$start_status = 1;
						}else{$start_status = 0;}
            if(Input::has('job_type_status_id')){
                $list = JobTypeStatusModel::find(Input::get('job_type_status_id'));
                $list->job_type_id = Input::get('job_type_id');
                $list->channel_id = Input::get('channel_id');
                $list->status_name = Input::get('status_name');
                $list->start_status = $start_status;
                $list->save();
                $alert['msg'] = 'Job type status has been  updated successfully';
                $alert['type'] = 'success';
            }else{
                $list = new JobTypeStatusModel;
                
                $list->job_type_id = Input::get('job_type_id');
                $list->channel_id = Input::get('channel_id');
                $list->status_name = Input::get('status_name');
                $list->start_status =$start_status;
                $list->save();
                $alert['msg'] = 'Job type status  has been saved successfully';
                $alert['type'] = 'success';
            }
            return Redirect::route('admin.jobTypeStatus')->with('alert', $alert);
        }
    }
    public function edit($id){
        $param['pageNo']= 18;
        $param['jobTypeStatus'] = JobTypeStatusModel::find($id);
        $param['jobType'] = JobTypeModel::WhereRaw(true)->orderBy('job_type_name','asc')->get();
        $param['channels'] = ChnnelsModel::WhereRaw(true)->orderBy('channel_name','asc')->get();
        return View::make('admin.jobTypeStatus.edit')->with($param);
    }
    public function suspend($id){
        $jobTypeStatus = JobTypeStatusModel::find($id);
        if($jobTypeStatus->active == 1) {
            $active = 0;
        }else{
            $active = 1;
        }
        $jobTypeStatus->active = $active;

        $jobTypeStatus->save();
        if($active == 0){
            $alert['msg'] = 'Job type status  has been suspended successfully';
        }else{
            $alert['msg'] = 'Job type status  has been activated successfully';
        }
        $alert['type'] = 'success';
        return Redirect::route('admin.jobTypeStatus')->with('alert', $alert);
    }
    public function delete($id){
        try {
            JobTypeStatusModel::find($id)->delete();
            $alert['msg'] = 'This job type status has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This job type status  has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.jobTypeStatus')->with('alert', $alert);
    }

}
<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,Request, Response,URL;
use JobType  as JobTypeModel, JobTypeStatus as JobTypeStatusModel, Channels as ChnnelsModel, JobTypeStatusFlow as JobTypeStatusFlowModel;
class JobTypeStatusFlowController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter(function () {
            if (!Session::has('user_id')) {
                return Redirect::route('admin.auth.login');
            }
        });
    }

    public function index()
    {
        $param['pageNo'] = 19;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['jobTypeStatusFlow'] = JobTypeStatusFlowModel::all();
        return View::make('admin.jobTypeStatusFlow.index')->with($param);
    }
    public  function create(){
        $param['pageNo']= 19;
        $param['channels'] = ChnnelsModel::WhereRaw(true)->orderBy('channel_name','asc')->get();
        if(count($param['channels'])>0){
            $param['jobType'] = JobTypeModel::WhereRaw(true)->orderBy('job_type_name','asc')->get();
            if(count($param['jobType'])>0){
                $channel = $param['channels'][0]->id;
                $jobType = $param['jobType'][0]->id;
                $param['jobTypeStatus'] = JobTypeStatusModel::WhereRaw('channel_id=? and job_type_id=?', array($channel,$jobType))->orderBy('status_name')->get();
            }else{
                $param['jobTypeStatus'] = JobTypeStatusModel::WhereRaw(true)->orderBy('status_name')->get();
            }
        }else{
            $param['jobTypeStatus'] = JobTypeStatusModel::WhereRaw(true)->orderBy('status_name')->get();
            $param['jobType'] = JobTypeModel::WhereRaw(true)->orderBy('job_type_name','asc')->get();
        }


        return View::make('admin.jobTypeStatusFlow.create')->with($param);
    }
    public function getStatus(){
        $channel_id = Input::get('channelSelect');
        $jobType_id = Input::get('jobTypeSelect');
        $jobTypeStatus = JobTypeStatusModel::whereRaw('channel_id =? and job_type_id=?',array($channel_id,$jobType_id))->get();
        if(count($jobTypeStatus)>0){
            $list = '';
            for($i =0; $i<count($jobTypeStatus); $i++){
                $list .='<option value="'.$jobTypeStatus[$i]->id.'">'.$jobTypeStatus[$i]->status_name.'</option>';
            }
            return Response::json(['result'=>'success', 'list' =>$list]);
        }else{
            return Response::json(['result' =>"empty"]);
        }
    }
    public function store(){
        $rules = [
            'job_type_id' =>'required',
            'channel_id' =>'required',
            'from_status_id' => 'required',
            'to_status_id' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else {
            if (Input::has('job_type_status_flow_id')) {
                $list = JobTypeStatusFlowModel::find(Input::get('job_type_status_flow_id'));
                $list->job_type_id = Input::get('job_type_id');
                $list->channel_id = Input::get('channel_id');
                $list->from_status_id = Input::get('from_status_id');
                $list->to_status_id = Input::get('to_status_id');
                $list->save();
                $alert['msg'] = 'Job type status flow has been  updated successfully';
                $alert['type'] = 'success';
            } else {
                $list = new JobTypeStatusFlowModel;
                $list->job_type_id = Input::get('job_type_id');
                $list->channel_id = Input::get('channel_id');
                $list->from_status_id = Input::get('from_status_id');
                $list->to_status_id = Input::get('to_status_id');
                $list->save();
                $alert['msg'] = 'Job type status flow  has been saved successfully';
                $alert['type'] = 'success';
            }
            return Redirect::route('admin.jobTypeStatusFlow')->with('alert', $alert);
        }
    }
    public  function edit($id){
        $param['pageNo']= 19;
        $param['jobTypeStatus'] = JobTypeStatusModel::WhereRaw(true)->orderBy('status_name')->get();
        $param['jobType'] = JobTypeModel::WhereRaw(true)->orderBy('job_type_name','asc')->get();
        $param['channels'] = ChnnelsModel::WhereRaw(true)->orderBy('channel_name','asc')->get();
        $param['jobTypeStatusFlow'] = JobTypeStatusFlowModel::find($id);

        return View::make('admin.jobTypeStatusFlow.edit')->with($param);
    }
    public function delete($id){
        try {
            JobTypeStatusFlowModel::find($id)->delete();
            $alert['msg'] = 'This job type status flow has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This job type status flow has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.jobTypeStatusFlow')->with('alert', $alert);
    }
}
<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,Request, Response,URL;
use Members as MembersModel, UserGroups as UserGroupsModel, UserGroupChannelRight as UserGroupChannelRightModel,ChannelRight as ChannelRightModel,
    Channels as ChnnelsModel,UserGroupStatusRight as UserGroupStatusRightModel, UserGroupWarehouseRight as UserGroupWarehouseRightModel,
    WarehousesRight as WarehousesRightModel, Warehouses as WarehouseModel, JobTypeRight as JobTypeRightModel, JobType as JobTypeModel, JobTypeStatus as JobTypeStatusModel;
class UserGroupController extends \BaseController
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
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['pageNo'] = 20;
        $param['userGroups'] = UserGroupsModel::all();
        return View::make('admin.userGroup.index')->with($param);
    }

    public function create(){
        $param['pageNo'] = 20;
        return View::make('admin.userGroup.create')->with($param);
    }
    public function store(){
        $rules = ['group_name'  => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $name = Input::get('group_name');
            if(Input::has('group_id')){
                $channel = UserGroupsModel::find(Input::get('group_id'));
                $channel->group_name = $name;
                $channel->save();
                $alert['msg'] = 'User Group  has been updated successfully';
                $alert['type'] = 'success';
            }else{
                $channel = new UserGroupsModel;
                $channel->group_name = $name;
                $channel->save();
                $alert['msg'] = 'User Group  has been saved successfully';
                $alert['type'] = 'success';
            }

        }
        return Redirect::route('admin.userGroup')->with('alert', $alert);
    }

    public function edit($id){
       $param['pageNo'] = 20;
       $param['userGroup'] = UserGroupsModel::find($id);
        return View::make('admin.userGroup.edit')->with($param);
    }
    public function delete($id){
        try {
            UserGroupsModel::find($id)->delete();
            $alert['msg'] = 'This user group has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This user group  has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.userGroup')->with('alert', $alert);
    }


    /*********Detail********/
    public function detail($id){
        $param['pageNo'] = 20;
        $param['userGroup'] = UserGroupsModel::find($id);
        $param['user'] = MembersModel::WhereRaw('userGroupID= ?', array($id))->get();
        $param['channels'] = ChnnelsModel::all();
        $param['channelRight']= ChannelRightModel::all();
        $param['jobType'] = JobTypeModel::all();

        $param['warehouse'] = WarehouseModel::all();
        $param['userGroupChannelRight'] = UserGroupChannelRightModel::WhereRaw('userGroupID = ?', array($id))->get();
        $param['userGroupStatusRight']  = UserGroupStatusRightModel::WhereRaw('userGroupID = ?', array($id))->get();
        $param['userGroupWarehouseRight'] = UserGroupWarehouseRightModel::WhereRaw('userGroupID = ?', array($id))->get();

        $param['userChannelRightFromBody'] = $this->getUserGroupChannelRight();
        $param['userChannelRightSelect'] = $this->getChanelRight();
        $param['userWarehouseRightFormBody'] = $this->getUserGroupWarehouseRight();
        $param['userWarehouseRightSelect'] = $this->getWarehouseRight();

        $param['userJobTypeRight'] = $this->getUserJobTypeRight();
        return View::make('admin.userGroup.detail')->with($param);
    }
    public function ajaxStore(){
       if(Request::ajax()){
                $rules = [
                    'group_name' => 'required',
                ];
                $validator = Validator::make(Input::all(), $rules);
                if ($validator->fails()) {
                    return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
                } else{
                    $groupID = Input::get('user_group_id');
                    $userGroup =UserGroupsModel::find($groupID);
                    $userGroup->group_name= Input::get('group_name');
                    $userGroup->save();
                    return Response::json(['result'=>'success','name' =>Input::get('group_name')]);
                }
        }
    }
    public function ajaxChannelStore(){
        if(Request::ajax()){
            $rules = [
                'channel' => 'required',
                'channel_right' => 'required',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
            } else{
               $userChannelRight = new UserGroupChannelRightModel;
               $userChannelRight->userGroupID = Input::get('userGroupID');
               $userChannelRight->channel_id = Input::get('channel');
               $userChannelRight->channel_right_id = Input::get('channel_right');
               $userChannelRight->save();
               $list =$this->getUserGroupChannelRight();
                $channel_right_select = $this->getChanelRight();
                return Response::json(['result'=>'success', 'list'=>$list,'channel_right_select' =>$channel_right_select]);
            }
        }
    }
    public function ajaxChannelRemove(){
        if(Request::ajax()){
            $id= Input::get('userGroupUserChannelRightID');
            UserGroupChannelRightModel::find($id)->delete();
            $list =$this->getUserGroupChannelRight();
            $channel_right_select = $this->getChanelRight();
            return Response::json(['result'=>'success', 'list'=>$list, 'channel_right_select' =>$channel_right_select]);
        }
    }

    public function ajaxWarehouseStore(){
        if(Request::ajax()){
            $rules = [
                'warehouse' => 'required',
                'warehouse_right' => 'required',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
            } else{
                $userWarehouseRight = new UserGroupWarehouseRightModel;
                $userWarehouseRight->userGroupID = Input::get('userGroupID');
                $userWarehouseRight->warehouse_id = Input::get('warehouse');
                $userWarehouseRight->warehouse_right_id = Input::get('warehouse_right');
                $userWarehouseRight->save();
                $list =$this->getUserGroupWarehouseRight();
                $channel_right_select = $this->getWarehouseRight();
                return Response::json(['result'=>'success', 'list'=>$list,'channel_right_select' =>$channel_right_select]);
            }
        }
    }

    public function ajaxWarehouseRemove(){
        if(Request::ajax()){
            $id= Input::get('userGroupUserWarehouseRightID');
            UserGroupWarehouseRightModel::find($id)->delete();
            $list =$this->getUserGroupWarehouseRight();
            $channel_right_select = $this->getWarehouseRight();
            return Response::json(['result'=>'success', 'list'=>$list, 'channel_right_select' =>$channel_right_select]);
        }
    }
    public  function  ajaxJobTypeRightStore(){

        $userGroupID = Input::get('userGroupID');
        $channelID = Input::get('channel');
        $jobTypeID = Input::get('job_type');
        $jobTypeStatusID =Input::get('job_type_status');
        $jobTypeRightID = Input::get('job_type_right');
        $countList = UserGroupStatusRightModel::whereRaw('userGroupID =? and channel_id=? and job_type_id =? and job_type_status_id=? and job_type_right_id =?',array($userGroupID,$channelID,$jobTypeID,$jobTypeStatusID,$jobTypeRightID))->get();
        if(count($countList) >0){
            return Response::json(['result'=>'exist']);
        }else{
            $list = new UserGroupStatusRightModel;

            $list->userGroupID = Input::get('userGroupID');
            $list->channel_id = Input::get('channel');
            $list->job_type_id = Input::get('job_type');
            $list->job_type_status_id = Input::get('job_type_status');
            $list->job_type_right_id = Input::get('job_type_right');
            $list->save();
            $list1= $this->getUserJobTypeRight();
            return Response::json(['result'=>'success', 'list'=>$list1]);
        }


    }
    public  function  ajaxJobTypeRightRemove(){
        if(Request::ajax()){
            $id= Input::get('userGroupUserWarehouseRightID');
            UserGroupStatusRightModel::find($id)->delete();
            $list =$this->getUserJobTypeRight();
            return Response::json(['result'=>'success', 'list'=>$list]);
        }
    }
    /****Channel Right Function*******/
    function getUserGroupChannelRight(){
        $list = "";
        $resultDiv = UserGroupChannelRightModel::all();
        for($i=0; $i<count($resultDiv); $i++){
            $list .="<tr>
                <td>".($i+1*1)."</td>
                <td>".$resultDiv[$i]->channel->channel_name."</td>
                <td>".$resultDiv[$i]->channelRight->channel_right_name."</td>
                <td>".$resultDiv[$i]->channelRight->description."</td>
                <td>
                    <form action='".URL::route('admin.userGroup.ajaxChannelRemove')."' method='post'>
                        <input type='hidden' name='userGroupUserChannelRightID' value='".$resultDiv[$i]->id."'>
                        <input type='hidden' name='got' value='1'>
                        <input type='button' class='btn red' value='remove' onClick='onRemoveUserGroupChannelRight(this)'>
                    </form>
                </td>
            </tr>";
        }
        return $list;
    }
    function getChanelRight(){
        $list = '';
        $resultDiv = UserGroupChannelRightModel::all();
        $channelRight = ChannelRightModel::all();
        $list .='<select name="channel_right" class="form-control">';
        for($j=0; $j<count($channelRight); $j++){
            $k=0;
            for($i=0; $i<count($resultDiv); $i++){
                if($channelRight[$j]->id == $resultDiv[$i]->channel_right_id){
                  $k++;
                }
            }
            if($k==0){
                $list .='<option value="'.$channelRight[$j]->id.'">'.$channelRight[$j]->channel_right_name.'</option>';
            }else{
                $k==0;
            }
        }
        $list .="</select>";
        return $list;
    }
    /****Channel Right Function*******/
    /****Warehouses Right Function*******/
    function getUserGroupWarehouseRight(){
        $list = "";
        $resultDiv = UserGroupWarehouseRightModel::all();
        for($i=0; $i<count($resultDiv); $i++){
            $list .="<tr>
                <td>".($i+1*1)."</td>
                <td>".$resultDiv[$i]->warehouse->warehouse_name."</td>
                <td>".$resultDiv[$i]->warehouseRight->warehouse_right_name."</td>
                <td>".$resultDiv[$i]->warehouseRight->description."</td>
                <td>
                    <form action='".URL::route('admin.userGroup.ajaxWarehouseRemove')."' method='post'>
                        <input type='hidden' name='userGroupUserWarehouseRightID' value='".$resultDiv[$i]->id."'>
                        <input type='button' class='btn red' value='remove' onClick='onRemoveUserGroupWarehousesRight(this)'>
                    </form>
                </td>
            </tr>";
        }
        return $list;
    }
    function getWarehouseRight(){
        $list = '';
        $resultDiv = UserGroupWarehouseRightModel::all();
        $warehouseRight = WarehousesRightModel::all();
        $list .='<select name="warehouse_right" class="form-control">';
        for($j=0; $j<count($warehouseRight); $j++){
            $k=0;
            for($i=0; $i<count($resultDiv); $i++){
                if($warehouseRight[$j]->id == $resultDiv[$i]->warehouse_right_id){
                    $k++;
                }
            }
            if($k==0){
                $list .='<option value="'.$warehouseRight[$j]->id.'">'.$warehouseRight[$j]->warehouse_right_name.'</option>';
            }else{
                $k==0;
            }
        }
        $list .="</select>";
        return $list;
    }
    /****Warehouses Right Function*******/
    function getUserJobTypeRight(){
        $list = '';
        $resultDiv = UserGroupStatusRightModel::all();
        for($i=0 ; $i<count($resultDiv); $i++){
            $list .="<tr>
                <td>".($i+1*1)."</td>
                <td>".$resultDiv[$i]->channel->channel_name."</td>
                <td>".$resultDiv[$i]->jobType->job_type_name."</td>
                <td>".$resultDiv[$i]->jobTypeStatus->status_name."</td>
                <td>".$resultDiv[$i]->jobTypeRight->job_type_right_name."</td>
                <td>
                    <form action='".URL::route('admin.userGroup.ajaxJobTypeRightRemove')."' method='post'>
                        <input type='hidden' name='userGroupUserWarehouseRightID' value='".$resultDiv[$i]->id."'>
                        <input type='button' class='btn red' value='remove' onClick='onRemoveUserGroupWarehousesRight(this)'>
                    </form>
                </td>
            </tr>";
        }
        return $list;
    }

    public  function getJobTypeStatus(){
        if(Request::ajax()){
            $jobType = Input::get('jobTypeSelect');
            $channel = Input::get('channel');
            $result= JobTypeStatusModel::WhereRaw('job_type_id =? and channel_id=?', array($jobType,$channel))->get();
            $list = '<select name="job_type_status" class="form-control" id="jobTypeStatusSelect" onchange="onChangeJobTypeStatus()">';
            $list .='<option value="">Status Name</option>';
            for($i=0; $i<count($result); $i++){
                $list .='<option value="'.$result[$i]->id.'">'.$result[$i]->status_name.'</option>';
            }
            $list.='</select>';
            $result12= JobTypeRightModel::WhereRaw('job_type_id =? ', array($jobType))->get();
            $secondList = '<select name="job_type_right" class="form-control" id="jobTypeStatusRightSelect" onchange="onChangeJobTypeRight()" >';
            $secondList .='<option value="">Right Name</option>';
            for($i=0; $i<count($result12); $i++){
                $secondList .='<option value="'.$result12[$i]->id.'">'.$result12[$i]->job_type_right_name.'</option>';
            }
            $secondList .='</select>';
            return Response::json(['result'=>'success', 'list'=>$list, 'right' =>$secondList]);
        }
    }
}
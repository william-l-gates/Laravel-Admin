<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Channels as ChnnelsModel, ChannelRight as ChannelRightModel;
class ChannelController extends \BaseController {
    public function __construct() {
        $this->beforeFilter(function(){
            if (!Session::has('user_id')) {
                return Redirect::route('admin.auth.login');
            }
        });
    }
    public function index() {
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['pageNo'] = 11;
        $param['channels'] = ChnnelsModel::all();
        return View::make('admin.channel.index')->with($param);
    }
    public function create(){
        $param['pageNo'] = 11;
        return View::make('admin.channel.create')->with($param);
    }
    public function store(){
        $rules = ['channel_name'  => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $name = Input::get('channel_name');
            if(Input::has('channel_id')){
                $channel = ChnnelsModel::find(Input::get('channel_id'));
                $channel->channel_name = $name;
                $channel->save();
                $alert['msg'] = 'Channel  has been updated successfully';
                $alert['type'] = 'success';
            }else{
                $channel = new ChnnelsModel;
                $channel->channel_name = $name;
                $channel->save();
                $alert['msg'] = 'Channel  has been saved successfully';
                $alert['type'] = 'success';
            }

        }
        return Redirect::route('admin.channel')->with('alert', $alert);
    }
    public function suspend($id){
        $channel = ChnnelsModel::find($id);
        if($channel->active == 1) {
            $active = 0;
        }else{
            $active = 1;
        }
        $channel->active = $active;

        $channel->save();
        if($active == 0){
            $alert['msg'] = 'Channel  has been suspended successfully';
        }else{
            $alert['msg'] = 'Channel  has been activated successfully';
        }
        $alert['type'] = 'success';
        return Redirect::route('admin.channel')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 11;
        $param['channel'] = ChnnelsModel::find($id);
        return View::make('admin.channel.edit')->with($param);
    }
    public function delete($id){
        try {
            ChnnelsModel::find($id)->delete();
            $alert['msg'] = 'This channel has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This channel  has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.channel')->with('alert', $alert);
    }
    public function channelRight(){
        $param['pageNo'] = 14;
        $param['channelRight'] =ChannelRightModel::whereRaw(true)->orderBy('channel_right_name','asc')->get();
        return View::make('admin.channel.channelRightList')->with($param);
    }
}
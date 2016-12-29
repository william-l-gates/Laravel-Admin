<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Warehouses  as WarehousesModel , WarehousesRight as WarehousesRightModel;
class WarehouseController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter(function () {
            if (!Session::has('user_id')) {
                return Redirect::route('admin.auth.login');
            }
        });
    }
    public function warehouseRight(){
        $param['pageNo']= 13;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['warehouses'] = WarehousesRightModel::WhereRaw(true)->orderBy('warehouse_right_name','asc')->get();
        return View::make('admin.warehouses.index')->with($param);
    }
    public function indexWarehouse(){
        $param['pageNo']= 16;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['warehouses'] = WarehousesModel::WhereRaw(true)->orderBy('warehouse_name','asc')->get();
        return View::make('admin.warehouses.indexWarehouse')->with($param);
    }
    public function create(){
        $param['pageNo']= 16;
        return View::make('admin.warehouses.create')->with($param);
    }
    public function store(){
        $rules = ['warehouse_name'  => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $name = Input::get('warehouse_name');
            if(Input::has('warehouse_id')){
                $channel = WarehousesModel::find(Input::get('warehouse_id'));
                $channel->warehouse_name = $name;
                $channel->save();
                $alert['msg'] = 'Warehouse  has been updated successfully';
                $alert['type'] = 'success';
            }else{
                $channel = new WarehousesModel;
                $channel->warehouse_name = $name;
                $channel->save();
                $alert['msg'] = 'Warehouse  has been saved successfully';
                $alert['type'] = 'success';
            }

        }
        return Redirect::route('admin.warehouses')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 11;
        $param['warehouse'] = WarehousesModel::find($id);
        return View::make('admin.warehouses.edit')->with($param);
    }
    public function suspend($id){
        $warehouse = WarehousesModel::find($id);
        if($warehouse->active == 1) {
            $active = 0;
        }else{
            $active = 1;
        }
        $warehouse->active = $active;

        $warehouse->save();
        if($active == 0){
            $alert['msg'] = 'Warehouse  has been suspended successfully';
        }else{
            $alert['msg'] = 'Warehouse  has been activated successfully';
        }
        $alert['type'] = 'success';
        return Redirect::route('admin.warehouses')->with('alert', $alert);
    }
    public function delete($id){
        try {
            WarehousesModel::find($id)->delete();
            $alert['msg'] = 'This warehouse has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This warehouse  has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.warehouses')->with('alert', $alert);
    }
}
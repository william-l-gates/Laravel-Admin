<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserGroupWarehouseRight  extends Eloquent {

    protected $table = 'user_group_warehouse_right';
    public function userGroup(){
        return $this->belongsTo('UserGroups', 'userGroupID');
    }
    public function warehouse(){
        return $this->belongsTo('Warehouses', 'warehouse_id');
    }
    public function warehouseRight(){
        return $this->belongsTo('WarehousesRight', 'warehouse_right_id');
    }
}
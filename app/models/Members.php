<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Members extends Eloquent {

    protected $table = 'users';
    public function userGroup() {
        return $this->belongsTo('UserGroups', 'userGroupID');
    }
}
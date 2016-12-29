<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserGroupStatusRight  extends Eloquent {

    protected $table = 'user_group_status_right';
    public function userGroup(){
        return $this->belongsTo('UserGroups', 'userGroupID');
    }
    public function channel(){
        return $this->belongsTo('Channels', 'channel_id');
    }
    public function jobType() {
        return $this->belongsTo('JobType', 'job_type_id');
    }
    public function jobTypeStatus(){
        return $this->belongsTo('JobTypeStatus', 'job_type_status_id');
    }
    public function jobTypeRight(){
        return $this->belongsTo('JobTypeRight', 'job_type_right_id');
    }
}
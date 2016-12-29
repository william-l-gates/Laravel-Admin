<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class JobTypeStatusFlow extends Eloquent {

    protected $table = 'job_type_status_flow';
    public function jobType() {
        return $this->belongsTo('JobType', 'job_type_id');
    }
    public function channel(){
        return $this->belongsTo('Channels', 'channel_id');
    }
    public function from(){
        return $this->belongsTo('JobTypeStatus', 'from_status_id');
    }
    public function to(){
        return $this->belongsTo('JobTypeStatus', 'to_status_id');
    }
}
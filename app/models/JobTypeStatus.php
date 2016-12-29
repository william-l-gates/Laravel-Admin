<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class JobTypeStatus extends Eloquent {

    protected $table = 'job_type_status';
    public function jobType() {
        return $this->belongsTo('JobType', 'job_type_id');
    }
    public function channel(){
        return $this->belongsTo('Channels', 'channel_id');
    }
}
<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class JobTypeRight extends Eloquent {

    protected $table = 'job_type_right';
    public function jobType() {
        return $this->belongsTo('JobType', 'job_type_id');
    }
}
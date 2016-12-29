<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserGroupChannelRight  extends Eloquent {

    protected $table = 'user_group_channel_right';
    public function userGroup(){
        return $this->belongsTo('UserGroups', 'userGroupID');
    }
    public function channel(){
        return $this->belongsTo('Channels', 'channel_id');
    }
    public function channelRight(){
        return $this->belongsTo('ChannelRight', 'channel_right_id');
    }
}
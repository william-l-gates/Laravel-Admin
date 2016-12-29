<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class OrderItems extends Eloquent {
    protected $table = 'orderitems';
    public function order() {
        return $this->belongsTo('Orders', 'Order_Id');
    }
}
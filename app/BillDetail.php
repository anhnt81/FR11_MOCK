<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'tb_order_detail';
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Order', 'oid','id');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'id','pid');
    }
}

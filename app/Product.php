<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tb_product';
    protected $guarded =[];

    public function category()
    {
        return $this->belongsTo('App\Category', 'cid','id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'bid', 'id');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment', 'pid', 'id');
    }

    public function slide()
    {
        return $this->hasOne('App\Slide', 'pid', 'id');
    }

    public function orderDetail()
    {
        return $this->hasOne('App\BillDetail', 'pid', 'id');
    }
}

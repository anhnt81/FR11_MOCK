<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tb_product';

    public function brand(){
        return $this->belongsTo('App\Brand','bid','id');
        //chung khóa ngoại với bảng Brand
    }
}

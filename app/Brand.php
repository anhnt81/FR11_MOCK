<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'tb_brand';
    public function product(){
        //đường dẫn,khóa ngoại,khóa chính
        return $this->hasMany('App\Product','bid','id');
        //chung khóa ngoại với bảng Product
    }
}

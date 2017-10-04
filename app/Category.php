<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'tb_category';
    protected $guarded =[];

    public function child()
    {
        return $this->belongsTo('App\Category', 'parentId', 'id');
    }

    public function product()
    {
        return $this->hasMany('App\Product', 'cid','id');
    }

    public function childHas(){
        return $this->hasMany('App\Category', 'parentId', 'id');
    }
}

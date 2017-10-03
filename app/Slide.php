<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'tb_slide';
    protected $guarded = [];

    public function product()
    {
        return $this->hasOne('App\Product', 'pid', 'id');
    }
}

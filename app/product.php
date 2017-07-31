<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    public function rate()
    {
    	return $this->hasMany('App\rate','product_id','id');
    }

    public function seen()
    {
    	return $this->hasMany('App\seen','product_id','id');
    }

    public function fav()
    {
    	return $this->hasMany('App\favorite','product_id','id');
    }
    public function childImage()
    {
    	return $this->hasMany('App\image','product_id','id');
    }

}

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
    public function image()
    {
    	return $this->hasMany('App\image','product_id','id');
    }
    public function seller()
    {
        return $this->hasOne('App\User','id','seller_id');
    }
     public function category()
    {
        return $this->hasOne('App\category','id','category_id');
    }
     public function parentCategory()
    {
        return $this->hasOne('App\category','id','parent_id');
    }
}

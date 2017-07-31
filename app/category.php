<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    public function child()
    {
    	return $this->hasMany('App\category','parent_id','id');
    }
     public function parentCategory()
    {
        return $this->hasOne('App\category','id','parent_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    //
    protected $fillable = ['product_id','buyer_id','qty'];
    public function products()
    {
    	return $this->hasOne('App\product','id','product_id');
    }
    public function sellers()
    {
    	return $this->hasOne('App\User','id','seller_id');
    }
}

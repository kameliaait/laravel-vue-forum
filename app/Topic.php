<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded=[];
    public function user(){
    	return $this->belongsTo('App\User'); 
    }
    	public function comments(){
    		return $this->morphMany('App\Comment','Commentable')->latest();
    	} 
   
}

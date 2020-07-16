<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded=[];
    public function commentable(){
    	return $this->morphTo();
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
   public function comments(){
   	return $this->morphMany('App\Comment','commentable')->latest();
   }
   }

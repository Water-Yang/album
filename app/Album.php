<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //可写字段
    protected $fillable = ['name','intro','cover'];
      //一对多：一个相册包含多个照片
    public function photos(){
    	return  $this->hasMany('App\Photo');
    }
}

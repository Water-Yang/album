<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //可写字段
    protected $fillable = ['album_id','name','intro','src'];
}

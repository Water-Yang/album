<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //可写字段
    protected $fillable = ['name','intro','cover'];
}

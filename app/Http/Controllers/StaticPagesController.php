<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Album;

class StaticPagesController extends Controller
{
   //首页
    public function home(){
        //返回
        $albums = Album::all();
        return view('home',compact('albums'));
    }
}

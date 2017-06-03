<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Album;

class AlbumsController extends Controller
{
    public function store(Request $request){
      
    	$this->validate($request, [
            'name' => 'required|max:50',
        ]);

      //数据存储
      $album = Album::create([
      		'name'=> $request->name,
      		'intro'=>$request->intro,
      		'password'=>$request->password,
      	]);
      //返回
      session()->flash('success','create successful');
      return back();
    }
    //获取相册数据
    public function show($id){
    	$album = Album::findOrFail($id);

    	return view('albums.show',compact('album'));
    }
    //更新相册的数据
    public function update(Request $request,$id){
    	$this->validate($request,[
    			'name'=>'required|max:50',
    		]);
    	//更新数据
    	$album = Album::findOrFail($id);
    	$album->update([
    			'name'=>$request->name,
    			'intro'=>$request->intro,
    		]);
    	session()->flash('success','edit successful');
    	return back();
    }
    //删除数据

    public function destroy($id){
    	//删除
    	$album = Album::findOrFail($id);
    	$album->delete();
    	session()->flash('success','delete successful');
    	return redirect()->route('home');
    }
}

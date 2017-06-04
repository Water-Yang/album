<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Album;
use App\Photo;

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
        $photos = $album->photos()->paginate(20);
    	return view('albums.show',compact(['album','photos']));
    }
    //更新相册的数据
    public function update(Request $request,$id){
    	
    		$file = $request->file('cover');
    		//文件是否成功
    		if($file->isValid()){
    			$realpath = $file->getRealPath();
    			$ext = $file->getClientOriginalExtension();
    			$filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
    			$bool=Storage::disk('uploads')->put($filename,file_get_contents($realpath));
    		}
    	
    	$this->validate($request,[
    			'name'=>'required|max:50',
    		]);
    	//更新数据
    	$album = Album::findOrFail($id);
    	$album->update([
    			'name'=>$request->name,
    			'intro'=>$request->intro,
    			'cover'=>'uploads/'.$filename,
    		]);

    	//session()->flash('success','edit successful');
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

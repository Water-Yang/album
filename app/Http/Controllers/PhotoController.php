<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Photo;

class PhotoController extends Controller
{
    //上传照片
    public function store(Request $request){
    	$file = $request->file('photo');
    	$realpath = $file->getRealPath();
    	if($file->isValid()){
    		$ext =$file->getClientOriginalExtension();
    		$filename = date('H-m-d-H-i-s').'-'.uniqid().'.'.$ext;
    		$bool = Storage::disk('uploads')->put($filename,file_get_contents($realpath));	
    	}
    	if($bool){
    		$photo = Photo::create([
    				'album_id'=>$request->album_id,
    				'name'=>$request->name,
    				'intro'=>$request->intro,
    				'src'=>'uploads/'.$filename,
    			]);
    		//session()->flash('success','upload successful');
    		return back();
    	}

    }

    //更新照片
    public function update(Request $request,$id){
    	//更新
    	$photo = photo::findOrFail($id);
    	$photo->update([
    		'name'=>$request->name,
    		'intro'=>$request->intro
    		]);
    	session()->flash('success','update successful');

    	return back();
    }
    //删除
    public function destroy($id){
    	$photo = photo::findOrFail($id);
    	$photo ->delete();
    	session()->flash('success','delete successful');
    	return back();
    }
}

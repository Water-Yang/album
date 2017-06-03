@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- 错误信息 -->
@include('shared.errors')

<!-- 创建相册：弹出框按钮 -->
<button type="button" class="btn btn-primary" style="margin-bottom:10px">Create album</button>

<!-- 相册展示 -->
<div class="row">
	@include('shared.album')
	@include('shared.album')
	@include('shared.album')
	@include('shared.album')
	@include('shared.album')
	@include('shared.album')
</div>

@endsection

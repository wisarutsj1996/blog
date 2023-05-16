@extends('theme')
@section('title', 'ดูโพส์')
@section('content')
<div class="row">
    <h1>ดูโพส์</h1>
    <div class="col-12 mb-3">
        <label>หัวข้อ</label>
        <div class="form-control">{{$posts->topic}}</div>
    </div>
    <div class="col-12 mb-3">
        <label>รายละเอียด</label>
        <div class="form-control">{{$posts->description}}</div>
    </div>
    @if($posts->image_file)
        <div class="col-12 mb-3">
            <label for="image_file">รูปภาพประกอบ</label>
            <div class="form-control text-center"><img src="{{asset('images/posts/'.$posts->image_file)}}" class="w-75"></div>
        </div>
    @endif
    <div class="col-12 mb-3 text-end">
        <a href="{{route('posts')}}" class="btn btn-dark">ย้อนกลับ</a>
    </div>
</div>
@endsection
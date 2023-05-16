@extends('theme')
@section('title', 'แก้ไขโพส์')
@section('content')
<div class="row">
    <h1>แก้ไขโพส์</h1>
    <form action="{{route('posts.update', $posts->id)}}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="col-12 mb-3">
            <label for="topic">หัวข้อ</label>
            <input type="text" name="topic" id="topic" class="form-control" value="{{old('topic', $posts->topic)}}">
            @error('topic')
                <span class="text-danger">{{$message}}</span>    
            @enderror
        </div>
        <div class="col-12 mb-3">
            <label for="description">รายละเอียด</label>
            <textarea name="description" id="description" rows="10" class="form-control">{{old('description', $posts->description)}}</textarea>
            @error('description')
                <span class="text-danger">{{$message}}</span>    
            @enderror
        </div>
        <div class="col-12 mb-3">
            <label for="image_file">รูปภาพประกอบ</label>
            <input type="file" name="image_file" id="image_file" class="form-control">
            @error('image_file')
                <span class="text-danger">{{$message}}</span>    
            @enderror
        </div>
        @if($posts->image_file)
            <div class="col-12 mb-3">
                <label for="image_file">รูปภาพประกอบ</label>
                <div class="form-control text-center">
                    <img src="{{asset('images/posts/'.$posts->image_file)}}" class="w-75">
                </div>
            </div>
        @endif
        <div class="col-12 mb-3 text-end">
            <button type="submit" class="btn btn-success">บันทึก</button>
            <a href="{{route('posts')}}" class="btn btn-dark">ย้อนกลับ</a>
        </div>
    </form>
</div>
@endsection
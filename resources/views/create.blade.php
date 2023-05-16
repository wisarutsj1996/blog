@extends('theme')
@section('title', 'สร้างโพส์')
@section('content')
<div class="row">
    <h1>สร้างโพส์</h1>
    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="col-12 mb-3">
            <label for="topic">หัวข้อ</label>
            <input type="text" name="topic" id="topic" class="form-control">
            @error('topic')
                <span class="text-danger">{{$message}}</span>    
            @enderror
        </div>
        <div class="col-12 mb-3">
            <label for="description">รายละเอียด</label>
            <textarea name="description" id="description" rows="10" class="form-control"></textarea>
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
        <div class="col-12 mb-3 text-end">
            <button type="submit" class="btn btn-success">บันทึก</button>
            <a href="{{route('posts')}}" class="btn btn-dark">ย้อนกลับ</a>
        </div>
    </form>
</div>
@endsection
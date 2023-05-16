@extends('theme')
@section('title', 'หน้าหลัก')
@section('content')
<center><h1>หน้าหลัก</h1></center>
<div class="col-12 mb-3 text-end"><a href="{{route('posts.create')}}" class="btn btn-outline-success">สร้าง</a></div>
@if(session('success'))
    <div class="col-12 alert alert-success mb-3">
        {{session('success')}}
    </div>
@endif
<div class="col-12">
    <table class="table">
        <thead>
            <tr>
                <th width="50">#</th>
                <th>หัวข้อ</th>
                <th width="200">ผู้สร้าง</th>
                <th width="150">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <th>{{$posts->firstItem()+$loop->index}}</th>
                    <td>{{$post->topic}}</td>
                    <td>{{$post->user_id}}</td>
                    <td>
                        <form action="{{route('posts.destroy', $post->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <a href="{{route('posts.show', $post->id)}}" class="btn btn-sm btn-primary">ดู</a>
                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-sm btn-warning">แก้ไข</a>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('คุณค้องการลบใช่หริอไม่?')">ลบ</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-12">{{$posts->links()}}</div>
@endsection
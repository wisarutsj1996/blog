<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $posts = new Post;
        $this->validateCheck($request);
        $image_file = $request->file('image_file');
        if($image_file) {
            $name_gen = date('YmdHis');
            $name_ext = strtolower($image_file->getClientOriginalExtension());
            $name_file = $name_gen.".".$name_ext;
            $image_file->move('images/posts/', $name_file);
            $posts->image_file = $name_file;
        }
        $posts->topic = $request->topic;
        $posts->description = $request->description;
        $posts->user_id = 1;
        $posts->save();
        return redirect()->route('posts')->with('success', 'สร้างโพส์เรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts = Post::findOrFail($id);
        return view('show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posts = Post::findOrFail($id);
        return view('edit', compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $posts = Post::findOrFail($id);
        $this->validateCheck($request);
        $image_file = $request->file('image_file');
        if($image_file) {
            $name_gen = date('YmdHis');
            $name_ext = strtolower($image_file->getClientOriginalExtension());
            $name_file = $name_gen.".".$name_ext;
            $path = "images/posts/";
            @unlink($path.$posts->image_file);
            $image_file->move($path, $name_file);
            $posts->image_file = $name_file;
        }
        $posts->topic = $request->topic;
        $posts->description = $request->description;
        $posts->save();
        return redirect()->route('posts')->with('success', 'แก้ไขโพส์เรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posts = Post::findOrFail($id);
        @unlink('images/posts/'.$posts->image_file);
        $posts->delete();
        return redirect()->route('posts')->with('success', 'ลบโพส์เรียบร้อยแล้ว');
    }

    private function validateCheck($request) {
        $request->validate(
            [
                'topic' => 'required|max:255',
                'description' => 'required',
                'image_file' => 'mimes:jpg,jpeg,png'
            ],
            [
                'topic.required' => 'โปรดกรอกหัวข้อ',
                'topic.max' => 'หัวข้อต้องไม่เกิน 255 ตัวอักศร',
                'description.required' => 'โปรดกรอกรายละเอียด',
                'image_file.mimes' => 'ไฟล์ภาพต้องเป็น JPG, JPEG, PNG'
            ]
        );
    }
}

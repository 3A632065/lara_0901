<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PostRequest;
use App\Post;

class AdminPostsController extends Controller
{
    public function index()
    {
        // return view('admin.posts.index');

        //使用 Model 查詢資料
        $post=Post::orderBy('created_at', 'DESC')->get();
        $data=['posts'=>$post];
        return view('admin.posts.index', $data);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    //在 PostsController的 edit內取得舊資料
    public function edit($id)
    {
        //$data = ['id' => $id];
        $post = Post::find($id);
        $data = ['post' => $post];
        return view('admin.posts.edit', $data);
    }

    //設定 AdminPostsController 對應的 function
    //public function store()
    //將表單送過來的資料用 Model 寫入資料庫
    public function store(PostRequest $request)
    {
        Post::create($request->all());
        //設定頁面跳轉
        return redirect()->route('admin.posts.index');
    }

    //在 PostsController的 update內更新資料
    public function update(PostRequest $request,$id)
    {
        $post = Post::find($id);
        $post->update($request->all());
        return redirect()->route('admin.posts.index');
    }

    //在 PostsController的 destroy內刪除資料
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('admin.posts.index');
    }

}

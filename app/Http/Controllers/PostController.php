<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('create-post', Auth::user())) {
            return view('post.create');
        }
        return redirect()->route('dashboard')->withErrors(['message'=>'Bạn không có quyền này']);   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:20',
            'content' => 'required|min:200'
        ], [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min ký tự'
        ], [
            'title' => 'Tiêu đề bài viết',
            'content' => 'Nội dung bài viết'
        ]);
        $validatedData['user_id'] = Auth::user()->id;
        Post::create($validatedData);
        return redirect('post')->with('msg', 'Tạo bài viết mới thành công');
    }
 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('post.read', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        if (Gate::allows('update-post', $post)) {
            $post = Post::find($id);
            return view('post.update', compact('post'));
        }
        return redirect()->route('dashboard')->withErrors(['message' => 'Bạn không có quyền này']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:20',
            'content' => 'required|min:200'
        ], [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min ký tự'
        ], [
            'title' => 'Tiêu đề bài viết',
            'content' => 'Nội dung bài viết'
        ]);

        $post = Post::find($id);
        $post['title'] = $validatedData['title'];
        $post['content'] = $validatedData['content'];
        $post->save();
        return redirect()->route('admin_post')->with('msg', 'Cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getUserPost() {
        if (Gate::allows('user-post', Auth::user())) {
            $posts = User::find(Auth::user()->id)->posts;
            return view('post.admin', compact('posts'));
        }
        return redirect()->back()->withErrors(['message' => 'Bạn không có quyền này']);
    }
}

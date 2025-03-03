<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        //$posts=Post::all();
        $posts=Post::paginate(10);
        return view('post.index', compact('posts'));

    }

    public function create() {
        return view('post.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    Post::create([
        'title' => $request->title,
        'body' => $request->body,
        'user_id' => auth()->id(),
    ]);

    return back()->with('message', '保存しました');
}

    public function show($id) {
        $post=Post::find($id);
        return view('post.show',compact('post'));

    }

    public function edit(Post $post) {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post) {
        $validated = $request->validate([
            'title' => 'required | max:20',
            'body' => 'required | max:400,'
        ]);
        $validated['user_id'] = auth()->id();

        $post->update($validated);

        $request->session()->flash('message', '更新しました');
        return back();
    }

        public function destroy(Request $request,Post $post) {
            $post->delete();
            $request->session()->flash('message', '削除しました');
            return redirect('post');
        }
    }
    /*public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|max:20',
        'body' => 'required|max:400',
    ]);

    $validated['user_id'] = auth()->id();

    $post = Post::create([
           'title' => $request->title,
           'body' => $request->body

    ]);

    $request->session()->flash('message', '保存しました');
        return back();
    }
    public function show($id)
    {
        $post = Post::findOrFail($id); // 🔹 データがない場合は 404 エラーを返す
        return view('posts.show', compact('post'));
    }


        /*public function show (Post $post) {
            return view('post.show', compact('post'));
        }

        public function show ($id) {
            $post=Post::find($id);
            //return view('post.show', compact('post'));
        }*/












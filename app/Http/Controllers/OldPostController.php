<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index() {
        $posts=Post::all();
        return view('post.index', compact('posts'));
    }

    public function create() {
        return view('post.create');
    }

    public function store(Request $request) {

         $validated = $request->validate([
            'title' => 'required | max:20',
            'body' => 'required | max:400',
        ]);

        $validated['user_id'] = auth()->id();


        $post = Post::create([

            'title' => $request->title,
            'body'  => $request->body
        ]);


        return back()->with('message', '保存しました');
        //return back();
    }
    public function show($id) {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return view('posts.show', compact('post'));
    }

    //public function show (Post $post){
        //$post = Post::find($id);
        // return view('post.show', compact('post'));
     //}

    public function edit(Post $post) {
        return view('post.edit', compact('post'));
    }




    public function update(Request $request, Post $post) {

        $validated = $request->validate([
          'title' => 'required | max:20',
           'body' => 'required | max:400',
       ]);


        $validated['user_id'] = auth()->id();
        $post->update($validated);

       $request->session()->flash('message', '更新しました');
        //return back();
    //}

       //public function destroy(Post $post) {
       // $post->delete();
       // return redirect()->route('post.index');
      // }

       public function destroy(Request $request,Post $post) {
       }
       }



    }











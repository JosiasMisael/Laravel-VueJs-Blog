<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Post;
use App\Tag;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $posts = Post::allowed()->get();  //Mostramos conforme la funcion que se declaro en el modelo
     return view('admin.posts.index',compact('posts'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','name')->get();
        $tags = Tag::select('id','name')->get();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


       $request->validate(['title'=>'required|unique:posts,title']);
       $post = Post::create([
           'title'=> $request->title,
           'user_id' => Auth::user()->id,
           ]);

        $this->authorize('create', new Post);
       $categories = Category::all();
       $tags = Tag::all();
       return redirect()->route('admin.posts.edit', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $this->authorize('update', $post);
       $post->update($request->all());
       $post->syncTags($request->tags);
        return redirect()->route('admin.posts.edit',$post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}

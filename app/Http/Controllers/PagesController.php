<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\PostResorce;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
    $query = Post::published();

    if(request('month'))
    {
        $query->whereMonth('published_at', request('month'));
    }

    if(request('year'))
    {
        $query->whereYear('published_at', request('year'));
    }

     $posts = $query->paginate();

     if (request()->wantsJson()) {

        return $posts;

     }
    // $posts = Post::published()->paginate();
    return view('pages.home',compact('posts'));
    }


    public function about()
    {
      return view('pages.about');
    }


    public function contact()
    {
      return view('pages.contact');
    }

    public function archive()
    {


        $data = [
           'authors'=> User::take(4)->get(),
           'categories'=>  Category::all(),
           'posts'=>Post::latest('published_at')->take(5)->get(),
           'archive'=> Post::published()->byYearAndMonth()->get(),
        ];

     if(request()->wantsJson()){
          return $data;
      }


     return view('pages.archive', $data);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        if ($post->isPublished() || auth()->check) {
            if(request()->wantsJson()){
                $post->load('user','category','tags','photos');
                return $post;
            }
        return view('posts.show', compact('post'));
        }
        abort(404);
   }

}

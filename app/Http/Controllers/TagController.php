<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {   $title = "Publicaciones de la etiqueta $tag->name";
        $posts = $tag->posts()
                     ->published()
                     ->paginate();

         if(request()->wantsJson()){
             return $posts;
         }
        return view('pages.home', compact('posts','title'));
    }
}

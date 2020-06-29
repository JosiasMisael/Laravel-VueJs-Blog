<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {   $title = "Publicaciones de la categoria $category->name";
        $posts = $category->posts()
                      ->published()
                      ->paginate();
        if( request()->wantsJson())
        {
         return $posts;
        }
     return view('pages.home', compact('posts','title'));
    }
}

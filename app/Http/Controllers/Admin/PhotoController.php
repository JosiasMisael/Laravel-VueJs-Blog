<?php


namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Photo;
use App\Post;

class PhotoController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(request(), [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        Photo::create([
            'url' =>'storage/'.request()->file('photo')->store('posts','public'),
            'post_id' => $post->id,
        ]);
    }

    public function destroy(Photo $photo)
    {
      $photo->delete();
      return back();
    }
}

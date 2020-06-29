<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $guarded =[];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($photo){

        $photoPath = str_replace('storage/','', $photo->url);
        Storage::disk('public')->delete($photoPath);

        });
    }

}

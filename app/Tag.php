<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Tag extends Model
{

    use Sluggable;
    protected $guarded = [];
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

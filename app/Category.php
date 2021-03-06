<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    protected $guarded =[];
    use Sluggable;
       public function posts(){
        return $this->hasMany(Post::class);
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

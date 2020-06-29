<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use Sluggable;
    protected $fillable = ['title','body','iframe','category_id','user_id','published_at','excerpt'];

    protected $dates = ['published_at'];

    protected $appends = ['published_date'];


    public function category()
    {
        return $this->belongsTo(Category::class);

    }
     public function tags()
     {
         return $this->belongsToMany(Tag::class);

     }
     public function photos()
     {
         return $this->hasMany(Photo::class);
     }

     public function user()
     {
        return $this->belongsTo(User::class);
     }

     public function scopePublished($query)
     {
       $query->with(['category','tags','user','photos'])
                  ->whereNotNull('published_at')
                   ->where('published_at','<=', Carbon::now())
                   ->latest('published_at');
     }
     public function scopeAllowed($query)
     {
        if( auth()->user()->can('view', $this)) //Un query scope, donde se pregunta si el usuario tiene acceso a la politica view
        {
         return $query;
        }

          return $query->where('user_id', auth()->id());

     }

     public function scopeByYearAndMonth($query)
     {
      return $query->selectRaw('year(published_at)  year')
                     ->selectRaw('month(published_at)  month')
                     ->selectRaw('monthName(published_at)  monthname')
                     ->selectRaw('count(*) posts')
                      ->groupBy('year','month','monthname')
                      ->orderBy('published_at');
     }

     public function getPublishedDateAttribute()
     {
         return optional($this->published_at)->format('d M Y');
     }
     public function sluggable()
     {
         return [
             'slug' => [
                 'source' => 'title'
             ],
         ];
     }

     public function getRouteKeyName()
     {
         return 'slug';
     }
      //Creacion de un mutado para verificar si existen la categoria seleccionada, de lo contrario, lo podra crear

     public function setCategoryIdAttribute($category_id)
     {
         $this->attributes['category_id'] =  Category::find($category_id)
          ? $category_id
          : Category::create(['name'=> $category_id])->id;
     }
     //funcion que se llama al controlador antes de guardar los tags, verifica si existen lo tags, de lo contrario los agrega
     public function syncTags($tags)
     {
        $tagsId= collect($tags)->map(function($tag){
            return  Tag::find($tag) ? $tag : Tag::create(['name'=>$tag])->id;
        });

        return $this->tags()->sync($tagsId);

     }
     //Se realiza los cambios a boot al momento de realizar la aliminacion de un post
     protected static function boot()
     {
         parent::boot();

         static::deleting(function($post){

        $post->tags()->detach();
        $post->photos->each->delete();

         });
     }

     public function  isPublished()
     {
         return ! is_null($this->published_at) && $this->published_at < today();
     }

     //Funcion para paginas polimorficas de vistas
     public function viewType($home = '')
     {
        if ($this->photos->count()=== 1) :
       return 'posts.photo';
       elseif ($this->photos->count()>1) :
         return $home === 'home' ? 'posts.carousel-preview' : 'posts.carousel';
       elseif($this->iframe) :
       return 'posts.iframe';
       else:
       return 'posts.text';
       endif;

     }




}

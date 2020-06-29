<?php

use App\Category;
use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;
use Carbon\Carbon;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Post::truncate();

        $pos = new Post;
        $pos->title = 'Primer Post';
        $pos->excerpt = 'Extracto de mi primer post';
        $pos->body = '<p>Contenido de mi primer post</p>';
        $pos->published_at = Carbon::now()->subDays(4);
        $pos->category_id=1;
        $pos->save();

        $pos = new Post;
        $pos->title = 'Segundo Post';
        $pos->excerpt = 'Extracto de mi segundo post';
        $pos->body = '<p>Contenido de mi segundo post</p>';
        $pos->published_at = Carbon::now()->subDays(3);
        $pos->category_id=2;
        $pos->save();

        $pos = new Post;
        $pos->title = 'Tercer Post';
        $pos->excerpt = 'Extracto de mi tercer post';
        $pos->body = '<p>Contenido de mi tercer post</p>';
        $pos->published_at = Carbon::now()->subDays(2);
        $pos->category_id=2;
        $pos->save();


        $pos = new Post;
        $pos->title = 'Cuarto Post';
        $pos->excerpt = 'Extracto de mi Cuarto post';
        $pos->body = '<p>Contenido de mi cuarto post</p>';
        $pos->published_at = Carbon::now();
        $pos->category_id=1;
        $pos->save();

           }
}

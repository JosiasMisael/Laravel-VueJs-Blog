@extends('layout')

@section('meta-title', $post->title . " | Blog")
@section('meta-content',$post->excerpt)

@push('styles')
<link rel="stylesheet" href="/css/carousel-bootstrap.css">
@endpush

@section('contenido')
<article class="post container">
    @include($post->viewType())
    <div class="content-post">
         @include('posts.headers')

        <h1>{{ $post->title }}</h1>

        <div class="divider"></div>
        <div class="image-w-text">
            {!! $post->body !!}
        </div>
        <footer class="container-flex space-between">
            @include('partials.social-links',['descriptions'=>$post->title])
             @include('posts.tags')
        </footer>
        <div class="comments">
            <div class="divider"></div>
            <div id="disqus_thread"></div>
             @include('partials.disqus-script');
        </div><!-- .comments -->
    </div>
</article>

@endsection


@push('scripts')
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
<script src="/js/carousel-bootstrap.js"></script>
@endpush

<header class="container-flex space-between">
    <div class="date">
        <span class="c-gray-1">{{$post->published_at->format('Y M d')}} / {{ $post->user->name }}</span>
    </div>
    <div class="post-category">
        <span class="category text-capitalize"><a href="{{ route('category.show', $post->category) }}">{{$post->category->name}}</a></span>
    </div>
</header>

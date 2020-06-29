<div class="tags container-flex">
    @forelse ($post->tags as $tag)
    <span class="tag c-gris text-capitalize"><a href="{{ route('tags.show', $tag) }}">#{{ $tag->name}}</a> </span>
    @empty
    <span class="tag c-gris text-capitalize">#No hay tags</span>
    @endforelse
</div>

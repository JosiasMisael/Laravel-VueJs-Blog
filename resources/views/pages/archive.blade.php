@extends('layout')

@section('contenido')
<section class="pages container">
    <div class="page page-archive">
        <h1 class="text-capitalize">archive</h1>
        <p>Nam efficitur, massa quis fringilla volutpat, ipsum massa consequat nisi, sed eleifend orci sem sodales lorem. Curabitur molestie eros urna, eleifend molestie risus placerat sed.</p>
        <div class="divider-2" style="margin: 35px 0;"></div>
        <div class="container-flex space-between">
            <div class="authors-categories">
                <h3 class="text-capitalize">authors</h3>
                <ul class="list-unstyled">
                    @forelse ($authors as $autor)
                    <li>{{ $autor->name }}</li>

                    @empty
                    <li>Aun no hay Autores</li>
                    @endforelse
                </ul>
                <h3 class="text-capitalize">categories</h3>
                <ul class="list-unstyled">
                    @forelse ($categories as $category)
                    <li class="text-capitalize"> <a href="{{ route('category.show', $category) }}">{{ $category->name }}</a></li>
                    @empty
                    <li class="text-capitalize">Aun no hay categorias</li>
                    @endforelse
                </ul>
            </div>
            <div class="latest-posts">
                <h3 class="text-capitalize">latest posts</h3>
                @forelse ($posts as $post)
                <p> <a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></p>
                @empty
                <p>No hay Posts Aun</p>
                @endforelse


                <h3 class="text-capitalize">posts by month</h3>
                <ul class="list-unstyled">
                    @forelse ($archive as $item)
                    <li class="text-capitalize"> <a href=" {{ route('page.home', ['month' => $item->month, 'year' => $item->year ]) }}">
                        {{ $item->monthname }} {{ $item->year }} ({{ $item->posts }})</a></li>
                    @empty
                    <li>Sin fecha</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</section>


@endsection

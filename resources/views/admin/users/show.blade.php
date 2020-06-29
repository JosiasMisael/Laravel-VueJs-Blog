@extends('admin.layout')

@section('content')
<div class="row">

    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="/adminlte/img/user4-128x128.jpg"
                        alt="{{ $user->name }}">
                </div>

                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                <p class="text-muted text-center">{{ $user->getRoleNames()->implode(', ') }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Publicaciones</b> <a class="float-right">{{ $user->posts->count() }}</a>
                    </li>
                    @if ($user->roles->count())
                    <li class="list-group-item">
                        <b>Roles</b> <a class="float-right">{{ $user->getRolDisplayName()}}</a>
                    </li>
                    @endif
                </ul>

                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-block"><b>Editar</b></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-header ">
              <h3 class="card-title">Publicaciones</h3>
            </div>
            <div class="card-body">
                @forelse ($user->posts as $post)
                    <a href="{{ route('post.show', $post) }}" target="_blank"><strong>{{ $post->title }}</strong></a><br>
                     <small class="text-muted">Publicado el: {{ $post->published_at->format('d/m/Y') }}</small><br>
                     @unless ($loop->last)
                        <hr>
                     @endunless
                @empty
                <small class="text-muted">No tiene Publicaciones</small><br>
                @endforelse
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-header ">
              <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body">
                @forelse ($user->roles as $role)
                    <strong>{{ $role->name }}</strong><br>
                    @if ($role->permissions->count())

                    <small class="text-muted">Permisos: {{ $role->permissions->pluck('name')->implode(', ') }} </small><br>
                    @endif
                    @unless ($loop->last)
                        <hr>
                     @endunless
                @empty
                <small class="text-muted">No tiene roles</small><br>
                @endforelse
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-header ">
              <h3 class="card-title">Permisos Extra</h3>
            </div>
            <div class="card-body">
                @forelse ($user->permissions as $permission)
                    <strong>{{ $permission->name }}</strong><br>
                     @unless ($loop->last)
                        <hr>
                     @endunless
                @empty
                <small class="text-muted">No tiene permisos extras</small><br>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection

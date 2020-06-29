@extends('admin.layout')

@section('header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Inicio</a></li>
                    <li class="breadcrumb-item "><a href="{{route('admin.users.index')}}">Listar Usuarios</a></li>
                    <li class="breadcrumb-item active">Editar Usuarios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
       <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Datos personales</h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.users.update', $user)}}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input class="form-control  @error('name') is-invalid @enderror"
                            placeholder="Ingrese el nombre de la publicacion" type="text" name="name"
                            value="{{old('name', $user->name)}}">
                        @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input class="form-control  @error('email') is-invalid @enderror"
                            placeholder="Ingrese el nombre de la publicacion" type="email" name="email"
                            value="{{old('email', $user->email)}}">
                        @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input class="form-control  @error('password') is-invalid @enderror"
                            placeholder="Ingrese la contraseña" type="password" name="password">
                            @error('password')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <span class="text-muted">Deja en blanco para no cambiar la contraseña</span>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirme la Contraseña </label>
                        <input class="form-control"
                            placeholder="Confirme la contraseña" type="password" name="password_confirmation">
                    </div>
                    <br>
                    <button class="btn btn-primary btn-block" type="submit">Guardar</button>

                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body">
                 @role('Admin')
                <form action="{{ route('admin.users.roles.update', $user) }}" method="POST">
                    @csrf  @method('PUT')
                    @include('admin.roles.checkboxes')
                  <button class="btn btn-primary btn-block">Actualizar Roles</button>
                </form>
                @else
                <ul class="list-group">

                    @if ($user->roles->count() === 0)
                    <li class="list-group-item">No tiene roles</li>
                    @else
                    @foreach ($user->roles as $rol)
                    <li class="list-group-item">{{ $rol->name }}</li>
                    @endforeach
                    @endif



                </ul>
                @endrole
            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Permisos</h3>
            </div>
            <div class="card-body">
                @role('Admin')
                <form action="{{ route('admin.users.permisos.update', $user) }}" method="POST">
                    @csrf  @method('PUT')
                    @include('admin.permissions.checkboxes',['model'=>$user])

                    <button class="btn btn-primary btn-block">Actualizar Permisos</button>
                </form>
                @else
                @forelse ($user->permissions as $permission)

                <li class="list-group-item">{{ $permission->name}}</li>
                @empty
                <li class="list-group-item">No cuenta con permisos</li>

                @endforelse


                @endrole
            </div>
        </div>
    </div>
</div>
</form>


@endsection

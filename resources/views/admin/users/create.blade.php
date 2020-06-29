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
                    <li class="breadcrumb-item active">Crear Usuarios</li>
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
                <form action="{{route('admin.users.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input class="form-control  @error('name') is-invalid @enderror"
                            placeholder="Ingrese el nombre de la publicacion" type="text" name="name"
                            value="{{old('name')}}">
                        @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input class="form-control  @error('email') is-invalid @enderror"
                            placeholder="Ingrese el nombre de la publicacion" type="email" name="email"
                            value="{{old('email')}}">
                        @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Roles</label>
                        @include('admin.roles.checkboxes')
                    </div>
                    <div class="form-group col-sm-6">
                        <label  >Permisos</label>
                        @include('admin.permissions.checkboxes',['model'=>$user])
                    </div>
                </div>

                    <br>
                    <span class="text-muted">La contraseña será generada y enviada al usuario por correo electronico</span>
                    <button class="btn btn-primary btn-block" type="submit">Crear Usuario</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>

</div>
@endsection

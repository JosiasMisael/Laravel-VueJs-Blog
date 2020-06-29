@extends('admin.layout')

@section('header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Actualizar Permisos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Inicio</a></li>
                    <li class="breadcrumb-item "><a href="{{route('admin.permissions.index')}}">Actualizar permissions</a>
                    </li>
                    <li class="breadcrumb-item active">Actualizar Permiso</li>
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
                <h3 class="card-title">Permisos</h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.permissions.update', $permission)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="display">Identificador</label>
                        <input class="form-control" value="{{ $permission->name}}" disabled>

                    </div>
                    <div class="form-group">
                        <label for="display_name">Nombre</label>
                        <input class="form-control  @error('display_name') is-invalid @enderror"
                            placeholder="Ingrese el nombre del permiso" type="text" name="display_name"
                            value="{{old('display_name', $permission->display_name)}}">
                        @error('display_name')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <br>

                    <button class="btn btn-primary btn-block" type="submit">Actualizar Permiso</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>

</div>
@endsection

@extends('admin.layout')

@section('header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Roles</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Inicio</a></li>
                    <li class="breadcrumb-item "><a href="{{route('admin.roles.index')}}">Listar Roles</a></li>
                    <li class="breadcrumb-item active">Crear Roles</li>
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
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.roles.store')}}" method="POST">
                     @include('admin.roles.form');
                    <button class="btn btn-primary btn-block" type="submit">Crear Roes</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>

</div>
@endsection

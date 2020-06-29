@extends('admin.layout')
@push('estilos')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@push('scripts')
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->

<script>
    $(function () {
        $('#post-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });

</script>
<!-- Modal -->
@endpush

@section('header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Roles</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

@endsection
@section('content')
{{-- <!-- Main content --> --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Listado de Usuarios</h3>
        @can('create', $roles->first())
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary float-right">
            <i class="fa fa-plus"></i>
            CrearRoles
        </a>

        @endcan
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="post-table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Permisos</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $rol)
                <tr>
                    <td>{{$rol->id}}</td>
                    <td>{{ $rol->display_name}}</td>
                    <td>{{ $rol->name}}</td>
                    <td>{{ $rol->permissions->pluck('name')->implode(', ')}}</td>
                    <td>
                        @can('update', $rol)
                        <a href="{{ route('admin.roles.edit', $rol) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-edit"></i>
                         </a>
                        @endcan
                    </td>
                    <td>
                        @can('delete', $rol)
                        @if ($rol->name !== 'Admin')
                        <form method="POST" action="{{ route('admin.roles.destroy', $rol) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Estas seguro de eliminar este post?')"><i
                            class="fa fa-trash"></i> </button>
                        </form>
                        @endif
                        @endcan
                    </td>
                </tr>
                @empty
                <td>No hay roles</td>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
{{-- <!-- /.card --> --}}

@endsection

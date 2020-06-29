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
                <h1 class="m-0 text-dark">POSTS</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Posts</li>
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
        <h3 class="card-title">Listado de publicaciones</h3>
        @can('create', $posts->first())
        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i
                class="fa fa-plus"></i> Crear Publicacion
        </button>
        @endcan
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="post-table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Extracto</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{ $post->title}}</td>
                    <td>{{ $post->excerpt}}</td>

                    <td>

                        <a href="{{ route('post.show', $post) }}" class="btn btn-default btn-sm" target="_blank" >
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        @can('update', $post)
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        @endcan
                    </td>
                  <td>
                      @can('delete', $post)
                      <form method="POST" action="{{ route('admin.posts.destroy', $post) }}">
                          @csrf @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estas seguro de eliminar este post?')"><i class="fa fa-trash"></i> </button>
                      </form>
                      @endcan
                    </td>
                </tr>
                @empty
                <td>No hay posts</td>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
{{-- <!-- /.card --> --}}

@endsection

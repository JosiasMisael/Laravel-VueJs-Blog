@extends('admin.layout')


@push('estilos')

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
<!-- Select2 -->
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.css">
<link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.css">
@endpush

@push('scripts')
<!-- bootstrap datepicker -->
<script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
{{--<script src="/adminlte/plugins/ckeditor/ckeditor.js"></script>--}}
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<!-- Select2 -->
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/min/dropzone.min.js"></script>
<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });
    //Initialize Select2 Elements
    $('.select2').select2({
        tags: true
    })

    CKEDITOR.config.height = 330;

let myDropzone = new Dropzone('.dropzone',{
   url :'/admin/posts/{{ $post->slug}}/photos',
   headers: {
    'X-CSRF-TOKEN':'{{ @csrf_token() }}'
    },
    acceptedFiles: 'image/*',
    maxFilesize: 5,
    paramName: 'photo',
    dictDefaultMessage: 'Arrastra las imagenes aqui'
});

myDropzone.on('error', (file, res)=>{
  let mensaje = res.errors.photo[0];
    $('.dz-error-message:last > span').text(mensaje);
});

Dropzone.autoDiscover = false;

</script>

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
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Inicio</a></li>
                    <li class="breadcrumb-item "><a href="{{route('admin.posts.index')}}">Listar Posts</a></li>
                    <li class="breadcrumb-item active">Crear Posts</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('content')
@if ($post->photos->count())
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-body">

            <div class="row">
                @foreach ($post->photos as $photo)
                <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
                    @method('DELETE') @csrf
                <div class="col-md-3">
                    <button class="btn btn-danger btn-sm" style="position: absolute"><i class="fa fa-remove">x</i></button>
                 <img src="{{ url($photo->url) }}" width="150" height="100" class="img-responsive" >
                </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
<form action="{{route('admin.posts.update', $post)}}" method="POST">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Administración de publicaciones</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombre de la publicacion</label>
                        <input class="form-control  @error('title') is-invalid @enderror"
                            placeholder="Ingrese el nombre de la publicacion" type="text" name="title"
                            value="{{old('title', $post->title)}}">
                        @error('title')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Contenido de la publicacion</label>
                        <textarea class="form-control  ckeditor" placeholder="Ingrese el complemento de la publicacion"
                            name="body" cols="30" rows="7">{{old('body', $post->body)}}</textarea>
                        @error('body')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Contenido embebido(Iframe)</label>
                        <textarea class="form-control" placeholder="Ingrese el contenido enbebido(iframe)"
                            name="iframe" cols="30" rows="3">{{old('iframe', $post->iframe)}}</textarea>
                        @error('iframe')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <label>Fecha:</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" name="published_at" class="form-control float-right" id="datepicker" value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null) }} ">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Categoria</label>
                        <select name="category_id" class="form-control select2 @error('category_id') is-invalid @enderror">
                            <option value="">Seleccione una categoria</option>
                            @foreach($categories as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('category_id', $post->category_id) == $categoria->id ? 'selected' : '' }}>{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Etiquetas</label>
                        <select class="select2 @error('tags') is-invalid @enderror" name="tags[]" multiple="multiple"
                            data-placeholder="Selecciona una o mas etiquetas" style="width: 100%;">
                            @foreach ($tags as $tag)
                            <option value="{{ $tag->id}}" {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name}}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Extracto de la publicacion</label>
                        <textarea class="form-control  @error('excerpt') is-invalid @enderror"
                            placeholder="Ingrese el extracto de la publicacion" name="excerpt" id="excerpt" cols="30"
                            rows="3">{{old('excerpt', $post->excerpt)}}</textarea>
                        @error('excerpt')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="dropzone"></div>
                    </div>


                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Guardar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>


@endsection

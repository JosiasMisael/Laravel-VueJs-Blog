@extends('layout')

@section('contenido')
<section class="pages container">
    <div class="page page-about">
        <h1 class="text-capitalize">Pagina no autorizada</h1>
        {{ $exception->getMessage() }}
         <p><a href="{{ url()->previous() }}">Regresar</a> </p>
    </div>
</section>

@endsection

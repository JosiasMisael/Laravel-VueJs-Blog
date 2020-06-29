<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form action="{{route('admin.posts.store', '#create')}}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingrese el titulo de la nueva publicacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre de la publicacion</label>
                        <input class="form-control  @error('title') is-invalid @enderror"
                            placeholder="Ingrese el nombre de la publicacion" id="title" type="text" name="title"
                            value="{{old('title')}}">
                        @error('title')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Crear Publicacion</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    if( window.location.hash === '#create'){
        $('#exampleModal').modal('show')
    }
    $('#exampleModal').on('hide.bs.modal', function(){
       window.location.hash = '#';
    })
    $('#exampleModal').on('shown.bs.modal', function(){
        $('#title').focus();
       window.location.hash = '#create';
    })
   </script>
@endpush

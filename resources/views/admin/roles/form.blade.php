@csrf
<div class="form-group">
    <label for="display">Identificador</label>
    @if ($role->exists)
    <input class="form-control" value="{{ $role->name}}" disabled>
    @else
    <input name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Ingrese el identificador del rol" value="{{ old('name', $role->name)}}"
        type="text">
        @error('name')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    @endif
</div>
<div class="form-group">
    <label for="display_name">Nombre</label>
    <input class="form-control  @error('display_name') is-invalid @enderror" placeholder="Ingrese el nombre del rol"
        type="text" name="display_name" value="{{old('display_name', $role->display_name)}}">
    @error('display_name')
    <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <label>Permisos</label>
        @include('admin.permissions.checkboxes',['model' =>$role])
    </div>
</div>
<br>

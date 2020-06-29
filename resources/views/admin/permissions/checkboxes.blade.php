@foreach ($permissions as $id => $name)
<div class="checkbox">
    <label for="">
         <input type="checkbox" name="permissions[]" id="" value="{{ $id }}"
         {{ $model->permissions->contains($id) || collect(old('permissions'))->contains($id) ? 'checked' : '' }}>
          {{ $name }}
    </label>
</div>
@endforeach

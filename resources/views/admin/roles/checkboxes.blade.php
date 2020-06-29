@foreach ($roles as $role)
<div class="checkbox">
    <label for="">
        <input type="checkbox" name="roles[]" id="" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
        {{ $role->name }} <br>
        <small class="text-muted">Permisos: {{ $role->permissions->pluck('name')->implode(', ') }}</small>
    </label>
</div>
@endforeach

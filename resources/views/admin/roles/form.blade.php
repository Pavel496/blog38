{{ csrf_field() }}
<div class="form-group">
  <label for="name">Identificator:</label>
  @if ($role->exists)
    <input value="{{ $role->name }}" class="form-control" disabled>
  @else
    <input name="name" value="{{ old('name', $role->name) }}" class="form-control">
  @endif
</div>

<div class="form-group">
  <label for="display_name">Name:</label>
  <input name="display_name"
      value="{{ old('display_name', $role->display_name) }}"
      class="form-control">
</div>

{{-- <div class="form-group">
  <label for="guard_name">Guard:</label>
  <select name="guard_name" class="form-control">
    @foreach (config('auth.guards') as $guardName => $guard)
      <option {{ old('guard_name', $role->guard_name) === $guardName ? 'selected' : '' }}
      value="{{ $guardName }}">{{ $guardName }}</option>
    @endforeach
  </select>
</div> --}}

{{-- <div class="form-group col-md-6">
    <label>Roles</label>
    @include('admin.roles.checkboxes')
</div> --}}

<div class="form-group col-md-6">
    <label>Permissions</label>
    @include('admin.permissions.checkboxes', ['model' => $role])
</div>

@extends('admin.layout')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create role</h3>
        </div>
        <div class="box-body">

          @include('admin.partials.error-messages')

          <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            {{ csrf_field() }} {{ method_field('PUT') }}

            <div class="form-group">
              <label for="name">Name:</label>
              <input name="name" value="{{ old('name', $role->name) }}" class="form-control">
            </div>

            <div class="form-group">
              <label for="guard_name">Guard:</label>
              {{-- <input name="guard_name" value="{{ old('guard_name') }}"
              class="form-control"> --}}
              <select name="guard_name" class="form-control">
                @foreach (config('auth.guards') as $guardName => $guard)
                  <option {{ old('guard_name', $role->guard_name) === $guardName ? 'selected' : '' }}
                  value="{{ $guardName }}">{{ $guardName }}</option>
                @endforeach
              </select>
            </div>

            {{-- <div class="form-group col-md-6">
                <label>Roles</label>
                @include('admin.roles.checkboxes')
            </div> --}}

            <div class="form-group col-md-6">
                <label>Permissions</label>
                @include('admin.permissions.checkboxes', ['model' => $role])
            </div>
            <button class="btn btn-primary btn-block">Create role</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

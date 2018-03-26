@extends('admin.layout')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data personal</h3>
        </div>
        <div class="box-body">

          @include('admin.partials.error-messages')

          <form method="POST" action="{{ route('admin.users.store') }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="name">Name:</label>
              <input name="name" value="{{ old('name') }}" class="form-control">
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <input name="email" value="{{ old('email') }}" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label>Roles</label>
                @include('admin.roles.checkboxes')
            </div>

            <div class="form-group col-md-6">
                <label>Permissions</label>
                @include('admin.permissions.checkboxes', ['model' => $user])
            </div>

            <span class="help-block">Пароль для нового пользователя был сгенерирован и выслан по email</span>

            <button class="btn btn-primary btn-block">Create user</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

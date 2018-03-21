@extends('admin.layout')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data personal</h3>
        </div>
        <div class="box-body">
          @if ($errors->any())
            <ul class="list-group">
              @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">
                  {{ $error }}
                </li>
              @endforeach
            </ul>
          @endif

          <form method="POST" action="{{ route('admin.users.update', $user) }}">
            {{ csrf_field() }} {{ method_field('PUT') }}

            <div class="form-group">
              <label for="name">Name:</label>
              <input name="name" value="{{ old('name', $user->name) }}" class="form-control">
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <input name="email" value="{{ old('email', $user->email) }}" class="form-control">
            </div>

            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" name="password" class="form-control" placeholder= "Password">
              <span class="help-block">Оставьте незаполненным, чтобы не менять пароль</span>
            </div>

            <div class="form-group">
              <label for="password_confirmation">Password confirmation:</label>
              <input type="password" name="password_confirmation" class="form-control" placeholder= "Password confirmation">
              <span class="help-block">Оставьте незаполненным, чтобы не менять пароль</span>
            </div>

            <button class="btn btn-primary btn-block">Update user</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

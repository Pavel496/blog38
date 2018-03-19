@extends('admin.layout')

@section('header')
  <h1>
    USERS
    <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
    {{-- <li><a href="{{ route('admin.users.create') }}"><i class="fa fa-pencil"></i> Create user</a></li> --}}
    <li class="active">All users</li>
  </ol>
@endsection

@section('content')
  <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">List of users</h3>
                <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus"></i> Create user</button>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="users-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                  </tr>
                  </thead>

                  <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                        <td>
                          {{-- <a href="{{ route('admin.user.show', $user) }}"
                            class="btn btn-xs btn-default"
                            target="_blank">
                            <i class="fa fa-eye"></i></span></a>
                          <a href="{{ route('admin.user.edit', $user) }}"
                            class="btn btn-xs btn-info">
                            <i class="fa fa-pencil"></i></span></a>
                          <form method="POST"
                            action="{{ route('admin.user.destroy', $user) }}"
                            style="display: inline">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-danger"
                              onclick="return confirm('Удалить этого пользователя?')"
                            ><i class="fa fa-times"></i></button>
                          </form> --}}
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
@endsection

@push('styles')
  <link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">
@endpush

@push('scripts')
  <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script>
    $(function () {
      $('#posts-table').DataTable(
      //   {
      //   "paging": true,
      //   "lengthChange": false,
      //   "searching": false,
      //   "ordering": true,
      //   "info": true,
      //   "autoWidth": false
      // }
    );
    });
  </script>

@endpush

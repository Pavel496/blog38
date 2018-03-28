@extends('admin.layout')

@section('header')
  <h1>
    ROLES
    <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
    <li class="active">All roles</li>
  </ol>
@endsection

@section('content')
  <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">List of roles</h3>
        @can('create', $roles->first())
          <a href="{{ route('admin.roles.create') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Create role</a>
        @endcan
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="roles-table" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>ID</th>
            <th>Identificator</th>
            <th>Nombre</th>
            <th>Permissions</th>
            <th>Actions</th>
          </tr>
          </thead>

          <tbody>
            @foreach ($roles as $role)
              <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->display_name }}</td>
                <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                <td>
                  {{-- <a href="{{ route('admin.roles.show', $role) }}"
                    class="btn btn-xs btn-default">
                    <i class="fa fa-eye"></i></span></a> --}}
                  @can('update', $role)
                    <a href="{{ route('admin.roles.edit', $role) }}"
                      class="btn btn-xs btn-info">
                      <i class="fa fa-pencil"></i></span></a>
                  @endcan

                  @can('delete', $role)
                    @if ($role->id !== 1)
                      <form method="POST"
                        action="{{ route('admin.roles.destroy', $role) }}"
                        style="display: inline">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        <button class="btn btn-xs btn-danger"
                          onclick="return confirm('Удалить эту роль?')"
                        ><i class="fa fa-times"></i></button>
                      </form>
                    @endif
                  @endcan
                </td>
              </tr>
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
      $('#roles-table').DataTable(
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

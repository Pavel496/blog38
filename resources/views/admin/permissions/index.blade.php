@extends('admin.layout')

@section('header')
  <h1>
    PERMISSIONS
    <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
    <li class="active">All permissions</li>
  </ol>
@endsection

@section('content')
  <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">List of permissions</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="roles-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Identificator</th>
                    <th>Nombre</th>
                    {{-- <th>Permissions</th> --}}
                    <th>Actions</th>
                  </tr>
                  </thead>

                  <tbody>
                    @foreach ($permissions as $permission)
                      <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->display_name }}</td>
                        {{-- <td>{{ $permission->permissions->pluck('name')->implode(', ') }}</td> --}}
                        <td>
                          {{-- <a href="{{ route('admin.roles.show', $role) }}"
                            class="btn btn-xs btn-default">
                            <i class="fa fa-eye"></i></span></a> --}}
                          @can('update', $permission)
                            <a href="{{ route('admin.permissions.edit', $permission) }}"
                              class="btn btn-xs btn-info">
                              <i class="fa fa-pencil"></i></span></a>
                          @endcan
                            {{-- @if ($permission->id !== 1)
                              <form method="POST"
                                action="{{ route('admin.roles.destroy', $permission) }}"
                                style="display: inline">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button class="btn btn-xs btn-danger"
                                  onclick="return confirm('Удалить это разрешение?')"
                                ><i class="fa fa-times"></i></button>
                              </form>
                            @endif --}}
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

@extends('admin.layout')

@section('header')
  <h1>
    POSTS
    <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
    <li><a href="{{ route('admin.posts.create') }}"><i class="fa fa-pencil"></i> Create post</a></li>
    <li class="active">All posts</li>
  </ol>
@endsection

@section('content')
  <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Data Table With Full Features</h3>
                <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus"></i> Create post</button>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="posts-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Actions</th>
                  </tr>
                  </thead>

                  <tbody>
                    @foreach ($posts as $post)
                      <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->excerpt }}</td>
                        <td>
                          <a href="{{ route('posts.show', $post) }}"
                            class="btn btn-xs btn-default"
                            target="_blank">
                            <i class="fa fa-eye"></i></span></a>
                          <a href="{{ route('admin.posts.edit', $post) }}"
                            class="btn btn-xs btn-info">
                            <i class="fa fa-pencil"></i></span></a>
                          <form method="POST"
                            action="{{ route('admin.posts.destroy', $post) }}"
                            style="display: inline">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-danger"
                              onclick="return confirm('Удалить эту публикацию?')"
                            ><i class="fa fa-times"></i></button>
                          </form>
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

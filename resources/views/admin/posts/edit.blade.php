@extends('admin.layout')

@section('header')
  <h1>
    POSTS
    <small>Create post</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
    <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Posts</a></li>
    <li class="active">Edit post</li>
  </ol>
@endsection

@section('content')
  <div class="row">
    @if ($post->photos->count())
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-body">
            <div class="row">
                @foreach ($post->photos as $photo)
                  <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
                    {{ method_field('DELETE') }} {{ csrf_field() }}
                    <div class="col-md-2">
                        <button class="btn btn-danger btn-xs" style="position: absolute">
                          <i class="fa fa-remove"></i>
                        </button>
                        <img class="img-responsive" src="{{ url($photo->url) }}">
                    </div>
                  </form>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
      {{ csrf_field() }} {{ method_field('PUT') }}
      <div class="col-md-8">
        <div class="box box-primary">
          {{-- <div class="box-header">
            <h3 class="box-title">Create post</h3>
          </div> --}}
            <div class="box-body">
              <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label>Title</label>
                <input name="title" class="form-control" value="{{ old('title', $post->title) }}" placeholder= "Enter title of post">

                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}

              </div>
              <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                <label>Body</label>
                <textarea rows="10" id="editor" name="body" class="form-control" placeholder= "Enter body of post">{{ old('body', $post->body) }}</textarea>

                {!! $errors->first('body', '<span class="help-block">:message</span>') !!}

              </div>

              <div class="form-group {{ $errors->has('iframe') ? 'has-error' : '' }}">
                <label>iFrame</label>
                <textarea rows="2" id="editor" name="iframe" class="form-control" placeholder= "Enter iframe of audio or video">{{ old('iframe', $post->iframe) }}</textarea>

                {!! $errors->first('iframe', '<span class="help-block">:message</span>') !!}

              </div>

            </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="box box-primary">
          {{-- <div class="box-header">
            <h3 class="box-title"></h3>
          </div> --}}
          <div class="box-body">

            <!-- Date -->
            <div class="form-group">
              <label>Date of publication</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="published_at"
                  class="form-control pull-right"
                  value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null) }}"
                  type="text"
                  id="datepicker">
              </div>
            </div>

            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
              <label>Category</label>
              <select name="category_id" class="form-control select2">
                <option value="">Select category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
              </select>

              {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}

            </div>

            <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
              <label>Tags</label>
              <select name="tags[]" class="form-control select2"
                      multiple="multiple"
                      data-placeholder="Select one or more tags" style="width: 100%;">
                  @foreach ($tags as $tag)
                    <option {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
                  @endforeach
              </select>
              {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
              <label>Excerpt</label>
              <textarea name="excerpt" class="form-control" placeholder= "Enter excerpt of post">{{ old('excerpt', $post->excerpt) }}</textarea>

              {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}

            </div>

            <div class="form-group">
              <div class="dropzone">

              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Save Publication</button>
            </div>

          </div>
        </div>
      </div>
    </form>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css">
  <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
  <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
  <script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script>
    $('#datepicker').datepicker({
      autoclose: true
    });

    $(".select2").select2({
      tags: true
    });

    CKEDITOR.replace('editor');
    CKEDITOR.config.height = 315;

    var myDropzone = new Dropzone('.dropzone', {
      url: '/admin/posts/{{ $post->url }}/photos',
      paramName: 'photo',
      acceptedFiles: 'image/*',
      maxFilesize: 2,
      // maxFiles: 1,
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      dictDefaultMessage: 'Бросьте фото для загрузки'
    });

    myDropzone.on('error', function(file, res){
      var msg = res.photo[0];
      $('.dz-error-message:last > span').text(msg);
    });

    Dropzone.autoDiscover = false;


  </script>
@endpush

@extends('layout')

@section('content')
  <section class="pages container">
    <div class="page page-about">
      <h1 class="text-capitalize">Страница не найдена</h1>
      <p>Перейти <a href="{{ route('pages.home') }}">Домой</p>
    </div>
  </section>
@endsection

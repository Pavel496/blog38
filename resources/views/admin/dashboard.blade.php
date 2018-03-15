@extends('admin.layout')

{{-- @section('header')
  <h1>
    Dashboard
    <small>Optional description</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Dashboard</li>
  </ol>
@endsection --}}

@section('content')

  <h1>Dashboard</h1>
  <p>Пользователь: {{auth()->user()->name}}</p>

@endsection

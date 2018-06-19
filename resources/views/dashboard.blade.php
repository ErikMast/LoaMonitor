@extends('layouts.app')

@section('content')

<div class="container">
  <div class="page-header">
      <div class="row">
          <div class="col-lg-8"><h1>Dashboard {{ $currentDay }}</h1></div>
      </div>
  </div>

  <div class="dashboard-links">
  </div>
  @if (count($errors) > 0)
      <div class="alert alert-danger">
          <strong>Oeps!</strong> Er is iets mis gegaan<br><br>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  @if ($message = Session::get('success'))
      <div class="alert alert-success">
          <p>{{ $message }}</p>
      </div>
  @endif
  <div class="dashboard-overview">
    {!! Form::open(['method'=>'GET','url'=>'/','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
    <a href="{{ url('/') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-erase"></span></a>

    <div class="input-group custom-search-form">
      <input type="text" class="form-control" name="keyword" placeholder="Search...">
      <span class="input-group-btn">
          <button class="btn btn-default-sm" type="submit">
              <i class="fa fa-search"><span class="glyphicon glyphicon-search"></span></i>
          </button>
      </span>

    {!! Form::close() !!}
  </div>

  <div class="dashboard-overview">
    <div class="dashboard_table">
      <div class="col-lg-4"><h4>Aantal studenten: {{ sizeof($students) }}</h4>
      </div>
        @include('students.table');
      </div>
    </div>

</div>
@endsection

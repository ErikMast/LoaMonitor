@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Studenten</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('students.create') }}"> Student toevoegen</a>
            </div>
        </div>
    </div>
    <div class="">
      {!! Form::open(['method'=>'GET','url'=>'/students','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
      <a href="{{ url('/students') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-erase"></span></a>

      <div class="input-group custom-search-form">
        <input type="text" class="form-control" name="keyword" placeholder="Search...">
        <span class="input-group-btn">
            <button class="btn btn-default-sm" type="submit">
                <i class="fa fa-search"><span class="glyphicon glyphicon-search"></span></i>
            </button>
        </span>

      {!! Form::close() !!}
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @include('students.table');

    {!! $students->render() !!}

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 margin-tb">
      <div class="pull-left">
        <h2>Logboek overzicht</h2>
      </div><div class="col-lg-1 pull-right">
          <a class="btn btn-primary" href="{{ route('logbookoverview') }}"> Terug</a>
      </div>
    </div>
  </div>
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
  @endif

  <div class="">
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="pull-left">
          <h3> {{ $keyword }}</h3>
        </div>
      </div>
    </div>
    <div class="col-lg-6 margin-tb">
      <table class="display table table-bordered table-condensed table-responsive dynamic-table">
        <thead>
          <tr>
            <th width="150px">Datum</th>
            <th width="300px">Naam</th>
          </tr>
        </thead>
        <tbody>
          @foreach($logbooks as $key => $log)
          <tr >
            <td>{{$log->date->format('d-m-Y')}}</td>
            <td>{{$log->Student->firstname}} {{$log->Student->lastname}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection

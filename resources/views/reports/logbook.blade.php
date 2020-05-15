@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 margin-tb">
      <div class="pull-left">
        <h2>Logboek overzicht</h2>
      </div>
    </div>
  </div>
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
  @endif

  <div class="">
    <div class="col-lg-6 margin-tb">
      <table class="display table table-bordered table-condensed table-responsive dynamic-table">
        <thead>
          <tr>
            <th width="300px">Progress</th>
            <th width="50px">Aantal</th>
            <th width="100px">Laatst gelogd</th>
          </tr>
        </thead>
        <tbody>
          @foreach($progresses as $key => $progress)
          <tr >
            <td>{{$key}}</td>
            <td>{{$progress["count"]}}</td>
              <td>{{ date("d-m-Y", strtotime($progress["lastdate"]))}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection

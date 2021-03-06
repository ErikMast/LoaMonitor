@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 margin-tb">
      <div class="pull-left">
        <h2>SBU overzicht</h2>
      </div>
    </div>
  </div>
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
  @endif

  <div class="">
    <div class="col-lg-3 margin-tb">
      <table class="display table table-bordered table-condensed table-responsive dynamic-table">
        <thead>
          <tr>
            <th width="50px">SBUs</th>
            <th width="50px">Aantal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sbustats as $sbustat)
          <tr >
            <td>{{$sbustat->som}}</td>
            <td>{{$sbustat->aantal}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection

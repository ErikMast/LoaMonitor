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


  <div class="dashboard-overview">
    <div class="dashboard_table">
      <div class="col-lg-4"><h4>Aantal studenten: {{ sizeof($students) }}</h4>
      </div>
        @include('students.table');
      </div>
    </div>
</div>
@endsection

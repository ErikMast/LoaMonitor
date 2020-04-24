@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Logboek ({{$student->firstname}} {{$student->lastname}})</h2>
        		</div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
          <th width= "100px">Datum</th>
          <th width= "200px">Voortgang</th>
          <th width= "200px">Waar</th>
          <th width= "200px">Opmerkingen</th>
        </tr>
        @foreach ($logbooks as $key => $logbook)
        <tr>
            <td>{{ $logbook->date->format('d-m-Y') }}</td>
            <td>{{ $logbook->progress }}</td>
            <td>{{ $logbook->specification }}</td>
            <td>{{ $logbook->remark }}</td>
        </tr>
        @endforeach
    </table>

    {!! $logbooks->render() !!}

</div>
@endsection

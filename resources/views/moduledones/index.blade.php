@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Voltooide modules ({{$student->firstname}} {{$student->lastname}})</h2>
                <h3>Overzicht</h3>
                <p>SBU: {{$student->sumOfSBU()}}<br>
                @include('moduledones.overview')
                <br></p>
        		</div>
            <div class="pull-right">
                <a class="btn btn-success"
                   href="{{ route('moduledones.create', ['student_id' => $student->id, 'user_id'=>Auth::user()->id]) }}"> Nieuwe voltooide module</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
          <th width= "100px">Gestart</th>
          <th width= "100px">Voltooid</th>
          <th width= "100px">Beoordeeld</th>
          <th width= "50px">Resultaat</th>
          <th>Module</th>
            <th width="280px">Actie</th>
        </tr>
        @foreach ($moduledones as $key => $moduledone)
        <tr>
            <td>{{ $moduledone->dateStartString() }}</td>
            <td>{{ $moduledone->dateEndString() }}</td>
            <td>{{ $moduledone->dateString() }}</td>
            <td>{{ $moduledone->result }}
            <td>{{ $moduledone->Module->fullName}}</td>
            <td>
              <a class="btn btn-info" href="{{ route('moduledones.show',$moduledone->id) }}">Info</a>
              <a class="btn btn-primary" href="{{ route('moduledones.edit',$moduledone->id) }}">Wijzig</a>
              {!! Form::open(['method' => 'DELETE',
                    'route' => ['moduledones.destroy', $moduledone->id],'style'=>'display:inline',
                    'onsubmit' => 'return confirm("Weet u zeker dat u deze Voltooide Module wilt verwijderen?")']) !!}
              {!! Form::submit('Verwijder', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
            </td>
          </tr>
          @endforeach
    </table>

    {!! $moduledones->render() !!}



</div>
@endsection

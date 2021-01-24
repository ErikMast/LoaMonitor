@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Voortgang ({{$student->firstname}} {{$student->lastname}})</h2>
        		</div>
            <div class="pull-right">
                <a class="btn btn-success"
                   href="{{ route('progresses.create', ['student_id' => $student->id, 'user_id'=>Auth::user()->id]) }}"> Nieuwe voortgang</a>
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
          <th width= "100px">Datum</th>
          <th width= "100px">Deadline</th>
          <th width= "50px">Gehaald?</th>
          <th>Tekst</th>
        </tr>

          @foreach ($progresses as $key => $progress)
          <tr>
              <td>{{ $progress->dateString() }}</td>
              <td>
                @if ($progress->hasDeadlineExpired())
                <span title="Er is een deadline" style="color:red">{{$progress->dateDeadlineString()}}</span>
                @else
                {{ $progress->dateDeadlineString() }}
                @endif
              </td>
              <td>{!! Form::checkbox('deadline_met',1, $progress->deadline_met, array('disabled')) !!}</td>
              <td>{{ $progress->notes}}</td>
              <td>
                <a class="btn btn-info" href="{{ route('progresses.show',$progress->id) }}">Info</a>
                <a class="btn btn-primary" href="{{ route('progresses.edit',$progress->id) }}">Wijzig</a>
                {!! Form::open(['method' => 'DELETE',
                      'route' => ['progresses.destroy', $progress->id],'style'=>'display:inline',
                      'onsubmit' => 'return confirm("Weet u zeker dat u deze Voortgang wilt verwijderen?")']) !!}
                {!! Form::submit('Verwijder', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
              </td>
            </tr>
            @endforeach
    </table>

    {!! $progresses->render() !!}




</div>
@endsection

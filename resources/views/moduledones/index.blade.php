@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Voltooide modules</h2>
                <h3>{{$student->firstname}} {{$student->lastname}}</h3>
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
            <th width= "100px">Date</th>
            <th>Module</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($moduledones as $key => $moduledone)
        <tr>
		         <td>{{ $moduledone->date }}</td>
            <td>{{ $moduledone->Module->domain}}{{$moduledone->Module->level}} ({{$moduledone->result}}) {{ $moduledone->Module->description}}</td>
            <td>
              <a class="btn btn-info" href="{{ route('moduledones.show',$moduledone->id) }}">Show</a>
              <a class="btn btn-primary" href="{{ route('moduledones.edit',$moduledone->id) }}">Edit</a>
              {!! Form::open(['method' => 'DELETE','route' => ['moduledones.destroy', $moduledone->id],'style'=>'display:inline']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
            </td>
          </tr>
          @endforeach
    </table>

    {!! $moduledones->render() !!}
</div>
@endsection
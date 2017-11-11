@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Notities</h2>
                @if (!$allStudents)
        		      <h3>{{$student->firstname}} {{$student->lastname}}</h3>
        		    @endif
            </div>
            <div class="pull-right">
                @if (!$allStudents)
                  <a class="btn btn-success" href="{{ route('notes.create', ['student_id' => $student->id, 'user_id'=>Auth::user()->id]) }}"> Nieuwe notitie</a>
                @else
                  <a class="btn btn-success" href="{{ route('notes.create', ['user_id'=>Auth::user()->id]) }}"> Nieuwe notitie</a>
                @endif
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
          @if ($allStudents)
		        <th width= "150px">Naam</th>
			      <th width= "100px">Studentnummer</th>
		      @endif
            <th width= "100px">Date</th>
            <th>Note</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($notes as $key => $note)
        <tr>
		        @if ($allStudents)
		          <td>{{ $note->Student->firstname}} {{ $note->Student->lastname}}</td>
              <td>{{ $note->Student->student_number}}</td>
		        @endif
		        <td>{{ $note->date }}</td>
            <td>{{ $note->notes }}</td>
            <td>
              <a class="btn btn-info" href="{{ route('notes.show',$note->id) }}">Show</a>
              <a class="btn btn-primary" href="{{ route('notes.edit',$note->id) }}">Edit</a>
              {!! Form::open(['method' => 'DELETE','route' => ['notes.destroy', $note->id],'style'=>'display:inline']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
            </td>
          </tr>
          @endforeach
    </table>

    {!! $notes->render() !!}
</div>
@endsection

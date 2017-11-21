@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> {{ $student->firstname }} {{ $student->lastname }}</h2>
            </div>
			<div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Terug</a>
            </div>

        </div>
    </div>
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
				<a href="{{ url('/students/' . $student->id . '/edit') }}" class="btn btn-warning">
				<i class="fa fa-pencil-square-o"></i>Update</a>
			</div>

        </div>
    </div>

	<div class="row">
        <div class="col-lg-3">{{ Form::label('naam', 'Naam: ') }}</div>
		<div class="col-lg-6">{{ $student->firstname }} {{ $student->lastname }}</div>
	</div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('student_number', 'Stamnr: ') }}</div>
        <div class="col-lg-6">{{ $student->student_number }}</div>
    </div>
		<div class="row">
	        <div class="col-lg-3">{{ Form::label('group', 'Klas: ') }}</div>
	        <div class="col-lg-6">{{ $student->Group->name }}</div>
	    </div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('village', 'Woonplaats - ETA: ') }}</div>
		<div class="col-lg-6">{{ $student->Village->name }} ({{ $student->eta }})</div>
	</div>

	<table class="display table table-bordered table-condensed table-responsive dynamic-table">
	  <thead>
	    <tr>
	      <th width="300px">Notitie</th>
	      <th>Modules</th>
	      <th width="300px">Acties</th>
	    </tr>
	  </thead>
	  <tbody>
	    <br>
	      <tr class="clickable-row" data-url="/student/{{ $student->id }}">
	        <td>
	          @foreach($student->notes as $note)
	          <strong>{{$note->NoteType->name}}</strong>
	          {{$note->date}} {{$note->notes}}<br>
	          @endforeach
	        </td>
	        <td>
						@foreach($student->modulesDoneSorted as $moduledone)
						<strong>{{$moduledone->Module->domain}}{{$moduledone->Module->level}}</strong>
						{{$moduledone->date}} {{$moduledone->Module->description}}<br>
						@endforeach
	        </td>
	        <td>
						<a href="{{ route('notes.index', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}">
	            <button class="btn btn-warning">
	              <span class="glyphicon glyphicon-info-sign"> Notities</span>
	            </button>
	          </a>
	          <a href="{{ route('notes.create', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}">
	            <button class="btn btn-warning">
	              <span class="glyphicon glyphicon-plus"> Notitie</span>
	            </button>
	          </a>
	        </td>
	      </tr>
	  </tbody>
	</table>

	{!! Form::close() !!}
</div>

@endsection

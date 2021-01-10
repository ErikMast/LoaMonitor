@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Voortgang bekijken</h2>
				<h3>Student: {{ $progress->Student->firstname }} {{ $progress->Student->lastname }}</h3>
            </div>
			<div class="pull-right">
                <a class="btn btn-primary" href="{{ route('progresses.index', ['student_id' => $progress->Student->id, 'user_id'=>Auth::user()->id]) }}"> Terug</a>
            </div>

        </div>
    </div>
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
				<a href="{{ url('/progresses/' . $progress->id . '/edit') }}" class="btn btn-warning">
				<i class="fa fa-pencil-square-o"></i>Update</a>
			</div>

        </div>
    </div>

	<div class="row">
        <div class="col-lg-3">{{ Form::label('date', 'Datum: ') }}</div>
        <div class="col-lg-6">{{ $progress->dateString() }}</div>
  </div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('date_deadline', 'Deadline: ') }}</div>
        <div class="col-lg-6">{{ $progress->dateDeadlineString() }}</div>
  </div>

		<div class="row">
	        <div class="col-lg-3">{{ Form::label('notes', 'Voortgang: ') }}</div>
	        <div class="col-lg-6">{{ $progress->notes }}</div>
	  </div>
	{!! Form::close() !!}
</div>

@endsection

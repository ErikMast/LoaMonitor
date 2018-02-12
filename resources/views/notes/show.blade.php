@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Notitie bekijken</h2>
				<h3>Student: {{ $note->Student->firstname }} {{ $note->Student->lastname }}</h3>
            </div>
			<div class="pull-right">
                <a class="btn btn-primary" href="{{ route('notes.index') }}"> Terug</a>
            </div>

        </div>
    </div>
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
				<a href="{{ url('/notes/' . $note->id . '/edit') }}" class="btn btn-warning">
				<i class="fa fa-pencil-square-o"></i>Update</a>
			</div>

        </div>
    </div>

	<div class="row">
        <div class="col-lg-3">{{ Form::label('notes', 'Docent: ') }}</div>
		<div class="col-lg-6">{{$note->user->firstname}} {{$note->user->lastname}}</div>
	</div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('notetype', 'Type: ') }}</div>
		<div class="col-lg-6">{{ $note->NoteType->name }}</div>
	</div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('notes', 'Notitie: ') }}</div>
		<div class="col-lg-6">{{ $note->notes }}</div>
	</div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('date', 'Datum: ') }}</div>
        <div class="col-lg-6">{{ $note->date->format('d-m-Y') }}</div>
    </div>
	{!! Form::close() !!}
</div>

@endsection

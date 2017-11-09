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
        <div class="col-lg-6">{{ Form::label('firstname', 'Voornaam: ') }}</div>
		<div class="col-lg-6">{{ $student->firstname }}</div>
	</div>
	<div class="row">
        <div class="col-lg-6">{{ Form::label('lastname', 'Achternaam: ') }}</div>
        <div class="col-lg-6">{{ $student->lastname }}</div>
    </div>
	{!! Form::close() !!}
</div>

@endsection

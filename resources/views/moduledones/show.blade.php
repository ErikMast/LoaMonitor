@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Voltooide module bekijken</h2>
				<h3>Student: {{ $moduledone->Student->firstname }} {{ $moduledone->Student->lastname }}</h3>
            </div>
			<div class="pull-right">
                <a class="btn btn-primary" href="{{ route('moduledones.index', ['student_id' => $moduledone->Student->id, 'user_id'=>Auth::user()->id]) }}"> Terug</a>
            </div>

        </div>
    </div>
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
				<a href="{{ url('/moduledones/' . $moduledone->id . '/edit') }}" class="btn btn-warning">
				<i class="fa fa-pencil-square-o"></i>Update</a>
			</div>

        </div>
    </div>

	<div class="row">
        <div class="col-lg-3">{{ Form::label('module', 'Module: ') }}</div>
		<div class="col-lg-6">{{ $moduledone->Module->domain}}{{$moduledone->Module->level}} {{ $moduledone->Module->description}}</div>
	</div>
	<div class="row">
				<div class="col-lg-3">{{ Form::label('sbu', 'SBU: ') }}</div>
				<div class="col-lg-6">{{ $moduledone->Module->sbu }}</div>
	</div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('date', 'Datum: ') }}</div>
        <div class="col-lg-6">{{ $moduledone->date }}</div>
    </div>
		<div class="row">
	        <div class="col-lg-3">{{ Form::label('result', 'Resultaat: ') }}</div>
	        <div class="col-lg-6">{{ $moduledone->result }}</div>
	  </div>
	{!! Form::close() !!}
</div>

@endsection

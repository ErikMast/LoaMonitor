@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Module bekijken</h2>
								<h3>Domein: {{ $module->domain }} Level {{ $module->level }}</h3>
            </div>
			<div class="pull-right">
                <a class="btn btn-primary" href="{{ route('modules.index') }}"> Terug</a>
            </div>

        </div>
    </div>
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
				<a href="{{ url('/modules/' . $module->id . '/edit') }}" class="btn btn-warning">
				<i class="fa fa-pencil-square-o"></i>Update</a>
			</div>

        </div>
    </div>

	<div class="row">
        <div class="col-lg-6">{{ Form::label('domain', 'Domein: ') }}</div>
		<div class="col-lg-6">{{ $module->domain }}</div>
	</div>
	<div class="row">
        <div class="col-lg-6">{{ Form::label('level', 'Level: ') }}</div>
        <div class="col-lg-6">{{ $module->level }}</div>
    </div>
		<div class="row">
	        <div class="col-lg-6">{{ Form::label('description', 'Beschrijving: ') }}</div>
	        <div class="col-lg-6">{{ $module->description }}</div>
    </div>
		<div class="row">
	        <div class="col-lg-6">{{ Form::label('sbu', 'SBU: ') }}</div>
	        <div class="col-lg-6">{{ $module->sbu }}</div>
    </div>
	{!! Form::close() !!}
</div>

@endsection

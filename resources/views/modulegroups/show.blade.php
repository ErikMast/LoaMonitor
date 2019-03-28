@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modulegroep bekijken</h2>
								<h3>Domein: {{ $modulegroup->domains }} </h3>
            </div>
			<div class="pull-right">
                <a class="btn btn-primary" href="{{ route('modulegroups.index') }}"> Terug</a>
            </div>

        </div>
    </div>
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
				<a href="{{ url('/modulegroups/' . $modulegroup->id . '/edit') }}" class="btn btn-warning">
				<i class="fa fa-pencil-square-o"></i>Update</a>
			</div>

        </div>
    </div>

	<div class="row">
        <div class="col-lg-6">{{ Form::label('domains', 'Domeinen: ') }}</div>
		<div class="col-lg-6">{{ $modulegroup->domain }}</div>
	</div>

		<div class="row">
	        <div class="col-lg-6">{{ Form::label('description', 'Beschrijving: ') }}</div>
	        <div class="col-lg-6">{{ $modulegroup->description }}</div>
    </div>

	{!! Form::close() !!}
</div>

@endsection

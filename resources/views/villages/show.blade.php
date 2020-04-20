@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Plaats bekijken</h2>

            </div>
			<div class="pull-right">
                <a class="btn btn-primary" href="{{ route('villages.index') }}"> Terug</a>
            </div>

        </div>
    </div>
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
				<a href="{{ url('/villages/' . $village->id . '/edit') }}" class="btn btn-warning">
				<i class="fa fa-pencil-square-o"></i>Update</a>
			</div>

        </div>
    </div>

	<div class="row">
        <div class="col-lg-6">{{ Form::label('name', 'Naam: ') }}</div>
		<div class="col-lg-6">{{ $village->name }}</div>
	</div>


	{!! Form::close() !!}
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> {{ $user->firstname }} {{ $user->lastname }}</h2>
            </div>
						<div class="col-lg-1 pull-right">
								<a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-warning">
									<i class="fa fa-pencil-square-o"></i>Aanpassen</a>
        	  </div><div class="col-lg-1 pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Terug</a>
            </div>

    </div>
	</div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('naam', 'Naam: ') }}</div>
		<div class="col-lg-6">{{ $user->firstname }} {{ $user->lastname }}</div>
	</div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('email', 'Email: ') }}</div>
        <div class="col-lg-6">{{ $user->email }}</div>
    </div>

	{!! Form::close() !!}
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Voortgang wijzigen</h2>
				<h3>Student: {{ $progress->Student->firstname }} {{ $progress->Student->lastname }}</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Terug</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Oeps!</strong> Er is wat mis met je invoer.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($progress, ['method' => 'PATCH','route' => ['progresses.update', $progress->id]]) !!}
    @include('progresses.form');
	{!! Form::close() !!}
</div>


@endsection

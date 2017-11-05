@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Notitie wijzigen</h2>
				<h3>Student: {{ $note->Student->firstname }} {{ $note->Student->lastname }}</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('notes.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($note, ['method' => 'PATCH','route' => ['notes.update', $note->id]]) !!}
    @include('notes.form');
	{!! Form::close() !!}
</div>

    
@endsection
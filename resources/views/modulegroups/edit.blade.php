@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modulegroep wijzigen</h2>
				<h3>Domein: {{ $modulegroup->domains }}</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('modulegroups.index') }}"> Terug</a>
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

    {!! Form::model($modulegroup, ['method' => 'PATCH','route' => ['modulegroups.update', $modulegroup->id]]) !!}
    @include('modulegroups.form');
	{!! Form::close() !!}
</div>


@endsection

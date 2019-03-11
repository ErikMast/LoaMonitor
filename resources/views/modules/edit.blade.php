@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Module wijzigen</h2>
				<h3>Domein: {{ $module->ModuleGroup->domains }} Level {{ $module->level }}</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('modules.index') }}"> Terug</a>
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

    {!! Form::model($module, ['method' => 'PATCH','route' => ['modules.update', $module->id]]) !!}
    @include('modules.form');
	{!! Form::close() !!}
</div>


@endsection

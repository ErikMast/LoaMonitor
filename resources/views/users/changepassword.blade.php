@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Aanpassen wachtwoord</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Terug</a>
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

    {!! Form::model($user, ['method' => 'POST', 'route' => ['updatepassword', $user->id]]) !!}
    <div class="row">
          <div class="col-lg-3">{!! Form::label('old_password', 'Oud wachtwoord: ') !!}</div>
          <div class="col-lg-3">{!! Form::password('old_password', ['class'=>'form-control']) !!}</div>
    </div>
    <div class="row">
          <div class="col-lg-3">{!! Form::label('password', 'Nieuw wachtwoord: ') !!}</div>
          <div class="col-lg-3">{!! Form::password('password', ['class'=>'form-control']) !!}</div>
    </div>
    <div class="row">
          <div class="col-lg-3">{!! Form::label('password_confirmation', 'Controle nieuw wachtwoord: ') !!}</div>
          <div class="col-lg-3">{!! Form::password('password_confirmation', ['class'=>'form-control']) !!}</div>
    </div>
    <div class="row">
      <div class="col-lg-3"></div>
  		<div class="col-lg-3"><button type="submit" class="btn btn-primary">Opslaan</button></div>
  	</div>
  	{!! Form::close() !!}

</div>
@endsection

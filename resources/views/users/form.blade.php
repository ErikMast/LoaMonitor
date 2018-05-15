{!! Form::hidden('password', $user->password) !!}
<div class="row">
    <div class="col-lg-3">{{ Form::label('firstname', 'Voornaam: ') }}</div>
		<div class="col-lg-3">{!! Form::text('firstname') !!}</div>
</div>
<div class="row">
    <div class="col-lg-3">{{ Form::label('lastname', 'Achternaam: ') }}</div>
    <div class="col-lg-3">{!! Form::text('lastname') !!}</div>
</div>
<div class="row">
    <div class="col-lg-3">{{ Form::label('email', 'Email: ') }}</div>
    <div class="col-lg-3">{!! Form::text('email') !!}</div>
</div>
<div class="row">
		<button type="submit" class="btn btn-primary">Opslaan</button>
</div>

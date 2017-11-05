<div class="row">
        <div class="col-lg-6">{{ Form::label('firstname', 'Voornaam: ') }}</div>
		<div class="col-lg-6">{!! Form::text('firstname') !!}</div>
	</div>
	<div class="row">
        <div class="col-lg-6">{{ Form::label('lastname', 'Achternaam: ') }}</div>
        <div class="col-lg-6">{!! Form::text('lastname') !!}</div>
    </div>
	<div class="row">
        <div class="col-lg-6">{{ Form::label('student_number', 'Studentnummer: ') }}</div>
        <div class="col-lg-6">{!! Form::text('student_number') !!}</div>
    </div>
	<div class="row">
        <div class="col-lg-6">{{ Form::label('villages_id', 'Woonplaats: ') }}</div>
		<div class="col-lg-6">{!! Form::select('villages', $villages, $student->Village->id) !!}</div>
	</div>
	<div class="row">
        <div class="col-lg-6">{{ Form::label('groups_id', 'Klas: ') }}</div>
        <div class="col-lg-6">{!! Form::select('groups', $groups, $student->Group->id) !!}</div>
    </div>
	<div class="row">
        <div class="col-lg-6">{{ Form::label('eta', 'Tijd: ') }}</div>
        <div class="col-lg-6">{!! Form::text('eta') !!}</div>
    </div>
	<div class="row">
		<button type="submit" class="btn btn-primary">Opslaan</button>
	</div>
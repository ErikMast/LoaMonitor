{!! Form::hidden('previous_groups_id', $student->previous_groups_id) !!}

<div class="row">
    <div class="col-lg-3">{{ Form::label('firstname', 'Voornaam: ') }}</div>
		<div class="col-lg-6">{!! Form::text('firstname') !!}</div>
	</div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('lastname', 'Achternaam: ') }}</div>
        <div class="col-lg-6">{!! Form::text('lastname') !!}</div>
    </div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('student_number', 'Studentnummer: ') }}</div>
        <div class="col-lg-6">{!! Form::text('student_number') !!}</div>
    </div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('villages_id', 'Woonplaats: ') }}</div>
		<div class="col-lg-6">{!! Form::select('villages_id', $villages, $student->Village->id) !!}</div>
	</div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('groups_id', 'Klas: ') }}</div>
        <div class="col-lg-6">{!! Form::select('groups_id', $groups, $student->Group->id) !!}</div>
    </div>
	<div class="row">
        <div class="col-lg-3">{{ Form::label('eta', 'Tijd: ') }}</div>
        <div class="col-lg-6">{!! Form::text('eta', '12:30:00') !!}</div>
    </div>
    <div class="row">
          <div class="col-lg-3">{{ Form::label('end_date', 'Datum afsluiten: ') }}</div>
          <div class="col-lg-6">{!! Form::date('end_date', $student->end_date) !!}</div>
  	</div>
	<div class="row">
		<button type="submit" class="btn btn-primary">Opslaan</button>
	</div>

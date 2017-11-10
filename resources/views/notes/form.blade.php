
<div class="row">
        <div class="col-lg-3">{{ Form::label('students_id', 'Student: ') }}</div>
		      <div class="col-lg-6">{!! Form::text('students_id') !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('users_id', 'User: ') }}</div>
		      <div class="col-lg-6">{!! Form::text('users_id') !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('note_types_id', 'Soort notitie: ') }}</div>
        <div class="col-lg-6">{!! Form::select('note_types_id', $notetypes, $note->NoteType->id) !!}</div>
</div>

<div class="row">
        <div class="col-lg-3">{{ Form::label('notes', 'Notitie: ') }}</div>
		<div class="col-lg-6">{!! Form::text('notes') !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('date', 'Datum: ') }}</div>
        <div class="col-lg-6">{!! Form::text('date') !!}</div>
</div>

<div class="row">
		<button type="submit" class="btn btn-primary">Opslaan</button>
</div>

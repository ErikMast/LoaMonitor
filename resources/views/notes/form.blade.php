
{!! Form::hidden('students_id', $note->Student->id) !!}
{!! Form::hidden('users_id', $note->User->id) !!}


<div class="row">
        <div class="col-lg-3">{{ Form::label('note_types_id', 'Soort notitie: ') }}</div>
        <div class="col-lg-6">{!! Form::select('note_types_id', $notetypes, $note->NoteType->id) !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('notes', 'Notitie: ') }}</div>
		<div class="col-lg-6">{!! Form::textarea('notes') !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('date', 'Datum: ') }}</div>
        @if ($note->id == null)
        <div class="col-lg-6">{!! Form::date('date', \Carbon\Carbon::now()) !!}</div>
        @else
        <div class="col-lg-6">{!! Form::date('date', $note->date) !!}</div>
        @endif
</div>

<div class="row">
		<button type="submit" class="btn btn-primary">Opslaan</button>
</div>

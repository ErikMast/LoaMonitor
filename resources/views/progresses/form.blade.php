
{!! Form::hidden('students_id', $progress->Student->id) !!}
{!! Form::hidden('users_id', $progress->User->id) !!}



<div class="row">
    <div class="col-lg-3">{{ Form::label('date', 'Datum: ') }}</div>
      <div class="col-lg-6">{!! Form::date('date', $progress->date) !!}</div>
</div>
<div class="row">
    <div class="col-lg-3">{{ Form::label('date_deadline', 'Deadline: ') }}</div>
    @if ($progress->id == null)
      <div class="col-lg-6">{!! Form::date('date_deadline', null) !!}</div>
    @else
      <div class="col-lg-6">{!! Form::date('date_deadline', $progress->date_deadline) !!}</div>
    @endif
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('notes', 'Voortgang: ') }}</div>
        <div class="col-lg-6">{!! Form::textarea('notes') !!}</div>
</div>

<div class="row">
		<button type="submit" class="btn btn-primary">Opslaan</button>
</div>

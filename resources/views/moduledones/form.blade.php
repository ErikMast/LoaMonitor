
{!! Form::hidden('students_id', $moduledone->Student->id) !!}
{!! Form::hidden('users_id', $moduledone->User->id) !!}


<div class="row">
        <div class="col-lg-3">{{ Form::label('modules_id', 'Module: ') }}</div>
        <div class="col-lg-6">{!! Form::select('modules_id', $modules, $moduledone->Module->id) !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('date_start', 'Startdatum: ') }}</div>
        @if ($moduledone->id == null)
        <div class="col-lg-6">{!! Form::date('date_start', \Carbon\Carbon::now()) !!}</div>
        @else
        <div class="col-lg-6">{!! Form::date('date_start', $moduledone->date_start) !!}</div>
        @endif
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('date_end', 'Einddatum: ') }}</div>
        @if ($moduledone->id == null)
        <div class="col-lg-6">{!! Form::date('date_end',null) !!}</div>
        @else
        <div class="col-lg-6">{!! Form::date('date_end', $moduledone->date_end) !!}</div>
        @endif
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('date', 'Datum: ') }}</div>
        @if ($moduledone->id == null)
        <div class="col-lg-6">{!! Form::date('date', null) !!}</div>
        @else
        <div class="col-lg-6">{!! Form::date('date', $moduledone->date) !!}</div>
        @endif
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('result', 'Resultaat: ') }}</div>
        <div class="col-lg-6">{!! Form::text('result') !!}</div>
</div>

<div class="row">
		<button type="submit" class="btn btn-primary">Opslaan</button>
</div>

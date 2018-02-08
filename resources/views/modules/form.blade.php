

<div class="row">
        <div class="col-lg-3">{{ Form::label('domain', 'Domein: ') }}</div>
        <div class="col-lg-6">{!! Form::select('domain', $domains, $module->domainInt()) !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('level', 'Level: ') }}</div>
        <div class="col-lg-6">{!! Form::select('level', $levels, $module->level) !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('description', 'Beschrijving: ') }}</div>
		<div class="col-lg-6">{!! Form::textarea('description') !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('sbu', 'SBU: ') }}</div>
		<div class="col-lg-6">{!! Form::text('sbu') !!}</div>
</div>

<div class="row">
		<button type="submit" class="btn btn-primary">Opslaan</button>
</div>

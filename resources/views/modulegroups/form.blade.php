

<div class="row">
        <div class="col-lg-3">{{ Form::label('domains', 'Domeinen: ') }}</div>
		<div class="col-lg-6">{!! Form::textarea('domains') !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('description', 'Beschrijving: ') }}</div>
		<div class="col-lg-6">{!! Form::textarea('description') !!}</div>
</div>


<div class="row">
		<button type="submit" class="btn btn-primary">Opslaan</button>
</div>

<div class="row">
        <div class="col-lg-3">{{ Form::label('name', 'Naam: ') }}</div>
        <div class="col-lg-6">{!! Form::text('name') !!}</div>
</div>

<div class="row">
        <div class="col-lg-3">{{ Form::label('sortorder', 'Sorteervolgorde: ') }}</div>
        <div class="col-lg-6">{!! Form::text('sortorder') !!}</div>
</div>
<div class="row">
      <div class="col-lg-3">{{ Form::label('is_visible', 'Zichtbaar (in dashboard)') }}</div>
      <!-- truuk om ongecheckte checkboxen te bewaren -->
      {!! Form::hidden('is_visible', 0); !!}
      <div class="col-lg-6">{!! Form::checkbox('is_visible',1, $group->is_visible) !!}</div>
</div>
<div class="row">
        <div class="col-lg-3">{{ Form::label('next_groups_id', 'Volgend jaar: ') }}</div>
        <div class="col-lg-6">{!! Form::select('next_groups_id', $groups, $group->next_groups_id) !!}</div>
</div>

<div class="row">
		<button type="submit" class="btn btn-primary">Opslaan</button>
</div>

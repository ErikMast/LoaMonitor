@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modules</h2>

            </div>
            <div class="pull-right">
              <a class="btn btn-success" href="{{ route('modules.create') }}"> Nieuwe module</a>

            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
	        <th width= "50px">Domein</th>
		      <th width= "50px">Level</th>
          <th>Beschrijving</th>
          <th>Sbu</th>
          <th>Acties</th>
        </tr>
        @foreach ($modules as $key => $module)
        <tr>
		        <td>{{ $module->ModuleGroup->domains}}</td>
            <td>{{ $module->level }}</td>
            <td>{{ $module->description }}</td>
            <td>{{ $module->sbu }}</td>
            <td><a class="btn btn-primary" href="{{ route('modules.edit',$module->id) }}">Wijzigen</a>
            @if ($module->canDelete())
              {!! Form::open(['method' => 'DELETE','route' => ['modules.destroy', $module->id],'style'=>'display:inline',
              'onsubmit' => 'return confirm("Weet u zeker dat u deze Module wilt verwijderen?")']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
            @endif
            </td>
          </tr>
          @endforeach
    </table>

    {!! $modules->render() !!}
</div>
@endsection

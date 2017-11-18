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
          <th>Berschrijving</th>
          <th>Acties</th>
        </tr>
        @foreach ($modules as $key => $module)
        <tr>
		        <td>{{ $module->domain}}</td>
            <td>{{ $module->level }}</td>
            <td>{{ $module->description }}</td>
            <td><a class="btn btn-primary" href="{{ route('modules.edit',$module->id) }}">Edit</a>
              </td>
          </tr>
          @endforeach
    </table>

    {!! $modules->render() !!}
</div>
@endsection

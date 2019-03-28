@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modulegroepen</h2>

            </div>
            <div class="pull-right">
              <a class="btn btn-success" href="{{ route('modulegroups.create') }}"> Nieuwe Modulegroep</a>

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
	        <th width= "50px">Domeinen</th>
		      <th>Beschrijving</th>
          <th>Acties</th>
        </tr>
        @foreach ($modulegroups as $key => $modulegroup)
        <tr>
		        <td>{{ $modulegroup->domains}}</td>
            <td>{{ $modulegroup->description }}</td>
            <td><a class="btn btn-primary" href="{{ route('modulegroups.edit',$modulegroup->id) }}">Wijzigen</a>
            @if ($modulegroup->canDelete())
              {!! Form::open(['method' => 'DELETE','route' => ['modulegroups.destroy', $modulegroup->id],'style'=>'display:inline',
              'onsubmit' => 'return confirm("Weet u zeker dat u deze Modulegroep wilt verwijderen?")']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
            @endif
            </td>
          </tr>
          @endforeach
    </table>

    {!! $modulegroups->render() !!}
</div>
@endsection

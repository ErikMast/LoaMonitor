@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Klassen</h2>

            </div>
            <div class="pull-right">
              <a class="btn btn-success" href="{{ route('groups.create') }}"> Nieuwe klas</a>

            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Oeps!</strong> Er moet nog iets gedaan worden...<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
          <th width= "50px">Id</th>
          <th width= "100px">Naam</th>
          <th width= "50px">Sorteervolgorde</th>
		      <th width= "50px">Volgende groep</th>
          <th>Acties</th>
        </tr>
        @foreach ($groups as $key => $group)
        <tr>
            <td>{{ $group->id}}</td>
            <td>{{ $group->name}}</td>
            <td>{{ $group->sortorder }}</td>
            <td>{{ $group->nextGroup() }}</td>
            <td><a class="btn btn-primary" href="{{ route('groups.edit',$group->id) }}">Wijzig</a>
              </td>
          </tr>
          @endforeach
    </table>

    {!! $groups->render() !!}
</div>
@endsection

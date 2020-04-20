@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Plaatsen</h2>

            </div>
            <div class="pull-right">
              <a class="btn btn-success" href="{{ route('villages.create') }}"> Nieuwe Plaats</a>

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
	        <th width= "250px">Naam</th>
          <th>Acties</th>
        </tr>
        @foreach ($villages as $key => $village)
        <tr>
		        <td>{{ $village->name}}</td>

            <td><a class="btn btn-primary" href="{{ route('villages.edit',$village->id) }}">Wijzigen</a>
            </td>
          </tr>
          @endforeach
    </table>

    {!! $villages->render() !!}
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
  <div class="page-header">
      <div class="row">
          <div class="col-lg-6"><h1>Verhuizen</h1>
            <p>Hier kun je klassen laten verhuizen naar de volgende klas. Dit gaat volgens de configuratie in de
              <a href="{{ url('/groups') }}">klassentabel.</a>
            </p>
            <p>Alleen de laatste actie kan teruggedraaid worden</p>
          </div>
      </div>
  </div>

  <div class="row">
    <form action="{{url('movestudents/move')}}" method="post" enctype="multipart/form-data">

        <div class="col-md-4">{{csrf_field()}}
                  <button class="btn btn-primary" type="submit">Uitvoeren</button>
			  </div>


	  </form>

    <form action="{{url('movestudents/revert')}}" method="post" enctype="multipart/form-data">
      <div class="col-md-4">{{csrf_field()}}
                <button class="btn btn-primary" type="submit">Terugdraaien</button>
      </div>
    </form>
  </div>

</div>

@endsection

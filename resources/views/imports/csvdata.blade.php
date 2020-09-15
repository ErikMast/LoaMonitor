@extends('layouts.app')

@section('content')
<div class="container">
  <div class="page-header">
      <div class="row">
          <div class="col-lg-4"><h1>Import Data</h1></div>
      </div>
  </div>


    <form action="{{url('csvdata/import')}}" method="post" enctype="multipart/form-data">
		<div class="row">
              <div class="col-md-4">
                {{csrf_field()}}
                <input type="file" name="imported-file"/>
              </div>

             <div class="col-md-4">
                  <button class="btn btn-primary" type="submit">Import</button>
			  </div>

		</div>
	</form>
  <h3>Uitleg</h3>
  <p>
    <ul>
      <li>Exporteer de studenten lijst uit Magister naar CSV</li>
      <li>Pas deze in Excel aan met Tekst naar kolommen (seperator komma, en dubbele quote voor de tekst)</li>
      <li>Bewaar als xlsx bestand</li>
      <li>Selecteer het bestand hier en druk op import</li>
    </ul>
  </p>
  <p>
    Woonplaatsen worden helaas niet meer geexporteerd door Magister :-(
  </p>
</div>

@endsection

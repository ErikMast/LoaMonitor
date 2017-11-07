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
		</div>
        <div class="row">
             <div class="col-md-4">
                  <button class="btn btn-primary" type="submit">Import</button>
			  </div>

		</div>
	</form>
</div>

@endsection

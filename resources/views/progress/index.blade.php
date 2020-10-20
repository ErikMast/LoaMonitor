@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Voortgang (Student Naam)</h2>
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
          <th width= "100px">Datum</th>
          <th width= "100px">Deadline</th>
          <th>Tekst</th>
        </tr>
        <tr>
            <td>10-10-2020</td>
            <td>12-10-2020</td>
            <td>Module A1 PHP is klaar op 12 okt. Verder alles op schema</td>
          </tr>
    </table>





</div>
@endsection

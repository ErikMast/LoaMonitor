@extends('layouts.app')

@section('content')
<div class="container">
  <div class="page-header">
      <div class="row">
          <div class="col-lg-4"><h1>Dashboard</h1></div>
      </div>
  </div>

  <div class="dashboard-links">
  </div>

  <h2>{{ $currentDay }}</h2>
  <br>
  <br>
  <div class="dashboard-overview">
    <div class="dashboard_table">
      <div class="col-lg-4"><h4>Aantal studenten: {{ sizeof($students) }}</h4>
      </div>
		    <table class="display table table-bordered table-condensed table-responsive dynamic-table">
          <thead>
            <tr>
              <th width="200px">Student</th>
              <th>Notitie</th>
              <th width="300px">Modules</th>
              <th width="300px">Acties</th>
            </tr>
          </thead>
          <tbody>
            <br>
            @foreach($students as $student)
              <tr class="clickable-row" data-url="/student/{{ $student->id }}">
                <td>
		              {{$student->firstname}} {{$student->lastname}}<br>
	                {{$student->student_number}} - {{$student->group->name}}<br>
	                {{$student->village->name}} - {{$student->eta}}
	              </td>
	              <td>
		              @foreach($student->mostRecentNotes as $note)
		              <strong>{{$note->NoteType->name}}</strong>
		              {{$note->date}} {{$note->notes}}<br>
	                @endforeach
	              </td>
                <td>
                  Modules komen hier
                </td>
	              <td>
    							<a href="{{ url('/students/' . $student->id ) }}">
                    <button class="btn btn-info">
                      <span class="glyphicon glyphicon-info-sign"> Info</span>
                    </button>
    							</a>
    							<a href="{{ route('notes.create', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}">
    							  <button class="btn btn-warning">
                      <span class="glyphicon glyphicon-plus"> Notitie</span>
                    </button>
    							</a>
    						</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
@endsection

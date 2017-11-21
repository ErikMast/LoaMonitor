<table class="display table table-bordered table-condensed table-responsive dynamic-table">
  <thead>
    <tr>
      <th width="200px">Student</th>
      <th width="300px">Notitie</th>
      <th width="120px"></th>
      <th>Modules</th>
      <th width="120px"></th>
    </tr>
  </thead>
  <tbody>
    <br>
    @foreach($students as $student)
      <tr class="clickable-row" data-url="/student/{{ $student->id }}">
        <td>
          <a href="{{ url('/students/' . $student->id ) }}">
          {{$student->firstname}} {{$student->lastname}}</a>
          <br>
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
          
        <a href="{{ route('notes.create', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}">
          <button class="btn btn-success">
            <span class="glyphicon glyphicon-plus"> Notitie</span>
          </button>
        </a>
        </td>
        <td>
          @foreach($student->modulesDoneSorted as $moduledone)
          <strong>{{$moduledone->Module->domain}}{{$moduledone->Module->level}}</strong>
          {{$moduledone->date}} {{$moduledone->Module->description}}<br>
          @endforeach
        </td>
        <td>
          <a href="{{ route('moduledones.create', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}">
            <button class="btn btn-success">
              <span class="glyphicon glyphicon-plus">Module</span>
            </button>
          </a>
        </td>
      </tr>
      @endforeach
  </tbody>
</table>

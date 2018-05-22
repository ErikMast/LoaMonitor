<table class="display table table-bordered table-condensed table-responsive dynamic-table">
  <thead>
    <tr>
      <th width="200px">Student</th>
      <th width="50px"></th>
      <th width="300px">Notitie</th>
      <th width="120px"></th>
      <th>Modules</th>
      <th width="120px"></th>
    </tr>
  </thead>
  <tbody>
    <br>
    <?php $currentGroup='';?>
    @foreach($students as $student)
      @if ($currentGroup!==$student->group->name)
      <tr>
        <td><h4>{{$student->group->name}}</h4></td>
      </tr>
      <?php $currentGroup=$student->group->name; ?>

      @endif
      <tr class="clickable-row" data-url="/student/{{ $student->id }}">
        <td onClick="document.location.href='{{ route('students.index')}}/{{ $student->id }}';">
          <strong>{{$student->firstname}} {{$student->lastname}}</strong>
          <br>
          {{$student->student_number}} - {{$student->group->name}}<br>
          {{ $student->Village->name }} ({{ $student->eta }})<br>
          @if ( $student->end_date != null)
            {{ $student->end_date->format('d-m-Y')}}<br>
          @endif
        </td>
        <td>
          @if ( $student->toBeCalled())
            <span class="glyphicon glyphicon-earphone icon-large" style="color:red;font-size: 20px"><br>
          @endif
        </td>
        <td onClick="document.location.href='{{ route('notes.index', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}';">
          @foreach($student->mostRecentNotes as $note)
          <strong>{{$note->NoteType->name}}</strong>
          {{$note->date->format('d-m-Y')}} {{$note->user->firstname}} {{$note->user->lastname}} <br> {{$note->notes}}<br>
          @endforeach
        </td>

        <td>

        <a href="{{ route('notes.create', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}">
          <button class="btn btn-success">
            <span class="glyphicon glyphicon-plus"> Notitie</span>
          </button>
        </a>
        </td>
        <td onClick="document.location.href='{{ route('moduledones.index', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}';">
          <strong>SBU: {{$student->sumOfSBU()}}</strong><br>
          @foreach($student->modulesDoneSorted as $moduledone)
          <strong>{{$moduledone->Module->domain}}{{$moduledone->Module->level}} ({{$moduledone->result}})</strong>
          {{$moduledone->date->format('d-m-Y')}} {{$moduledone->Module->description}} ({{$moduledone->Module->sbu}})<br>
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

<table class="display table table-bordered table-condensed table-responsive dynamic-table">
  <thead>
    <tr>
      <th width="200px">Student</th>
      <th width="40px"></th>
      <th width="250px">Notitie</th>
      <th width="250px">Logboek</th>
      <th>Modules</th>
      <th width="100px">Acties</th>
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
            <span title="Er is minimaal 21 dagen geen contact geweest" class="glyphicon glyphicon-earphone icon-large" style="color:red;font-size: 20px"><br></span>
          @endif
          <!--
          @if ( $student->toBeLogging())
            <span title="Er is minimaal 5 dagen geen logboek ingevuld" class="glyphicon glyphicon-list icon-large" style="color:red;font-size: 20px"><br></span>
          @endif
          -->
        </td>
        <td onClick="document.location.href='{{ route('notes.index', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}';">
          @foreach($student->mostRecentNotes as $note)
          <strong>{{$note->NoteType->name}}</strong>
          {{$note->date->format('d-m-Y')}} {{$note->user->firstname}} {{$note->user->lastname}} <br> {{str_limit($note->notes, $limit = 150, $end = ' ...') }}<br>
          @endforeach
        </td>
        <td onClick="document.location.href='{{ route('logbooks', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}';">
          @foreach($student->mostRecentLogbook as $logbook)
          <strong>{{$logbook->date->format('d-m-Y')}}</strong><br>
          <strong>Module:</strong>{{$logbook->progress}}<br>
          @if ($logbook->specification != null)
            <strong>Waar:</strong>{{$logbook->specification}}<br>
          @endif
          @if ($logbook->remark != null)
            <strong>Vragen:</strong>{{$logbook->remark}}<br>
          @endif
          <br>
          @endforeach
          <br>
        </td>
        <td onClick="document.location.href='{{ route('moduledones.index', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}';">
          <strong>SBU: {{$student->sumOfSBU()}}</strong><br><br>
          @include('moduledones.overview')<br>
          @foreach($student->modulesDoneSorted as $moduledone)
            <strong>{{$moduledone->descriptionHeader()}}</strong>

            {{$moduledone->descriptionBody()}}<br>
          @endforeach

        </td>
        <td>
          <a href="{{ route('notes.create', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}">
            <button class="btn btn-warning">
              <span class="glyphicon glyphicon-plus"> Notitie</span>
            </button>
          </a>
          <a href="{{ route('moduledones.create', ['student_id' => $student->id, 'user_id'=>Auth::user()->id])}}">
            <button class="btn btn-success">
              <span class="glyphicon glyphicon-plus"> Module</span>
            </button>
          </a>
        </td>
      </tr>
      @endforeach
  </tbody>
</table>

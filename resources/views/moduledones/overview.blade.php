<table class="table-bordered">
    <tr>
    <?php
      $modulesOverview = $student->overviewModuleDones();
      $currentLevel = '';
    ?>
    @foreach ($modulesOverview['results'] as $moduledone)
      @if ($currentLevel != $moduledone['level'])
        </tr>
        <tr>
        <?php $currentLevel = $moduledone['level']; ?>
        <td width="30px" title="level {{$currentLevel }}" style="text-align:center;">{{$currentLevel }}</td>
      @endif

      <td width="30px" title="{{ $moduledone['description'] }}"

      @if ($moduledone['result'] != '')
        style="background-color: #bde9ba;text-align:center;"
      @else
        style="text-align:center;"
      @endif
      >{{ $moduledone['domain'] }}{{ $moduledone['level'] }}</td>
    @endforeach
    </tr>
    <tr>
      <td width="30px" >BSA</td>
      <td width="30px" title="Alle modules level 1"
      @if ($modulesOverview['bsa'][0] == 'true')
        style="background-color: #bde9ba; text-align:center;"
      @else
        style="text-align:center;"
      @endif
      >1</td>
      <td width="30px" title="2 modules level 2, waarvan minimaal 1 A of C"
      @if ($modulesOverview['bsa'][1] == 'true')
        style="background-color: #bde9ba; text-align:center;"
      @else
        style="text-align:center;"
      @endif
      >2</td>
      <td width="30px" title="Alle modules level 2"
      @if ($modulesOverview['bsa'][2] == 'true')
        style="background-color: #bde9ba; text-align:center;"
      @else
        style="text-align:center;"
      @endif
      >3</td>
    </tr>
</table>

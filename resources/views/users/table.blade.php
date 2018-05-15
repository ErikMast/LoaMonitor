<table class="display table table-bordered table-condensed table-responsive dynamic-table">
  <thead>
    <tr>
      <th width="60px">Voornaam</th>
      <th width="60px">Achternaam</th>
      <th width="100px">email</th>
      <th width="50px">email</th>

    </tr>
  </thead>
  <tbody>
    <br>
    @foreach($users as $user)
      <tr class="clickable-row" data-url="/user/{{ $user->id }}">
        <td>{{$user->firstname}}</td>
        <td>{{$user->lastname}}</td>
        <td>{{$user->email}}</td>
        <td><a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Wijzigen</a>
          </td>
      </tr>
      @endforeach
  </tbody>
</table>

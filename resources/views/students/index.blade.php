@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Studenten</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('students.create') }}"> Create New Item</a>
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
            <th width="150px">Naam</th>
            <th width="100px">Studentnr.</th>
            <th>Klas</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($students as $key => $student)
    <tr>
        <td>{{ $student->firstname }} {{ $student->lastname }}</td>
        <td>{{ $student->student_number }}</td>
        <td>{{ $student->Group->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('students.show',$student->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
            
        </td>
    </tr>
    @endforeach
    </table>

    {!! $students->render() !!}
</div>
@endsection

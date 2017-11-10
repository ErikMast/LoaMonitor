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

    @include('students.table');

    {!! $students->render() !!}
</div>
@endsection

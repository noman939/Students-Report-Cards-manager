@extends('backend.layouts.layout')

@section('content')
    @if(Session::has('status'))
        <div class="alert alert-success">
            <h4>{{Session::get('status')}}</h4>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Students Section</h2>
        @if(Auth::user()->role == "Super Admin" || Auth::user()->role == "Teacher")
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{route('student.create')}}" type="button"
                       class="btn btn-sm btn-outline-primary">Add New Student</a>
                </div>
            </div>
        @endif
    </div>

    @if(!$students->isEmpty())
    <div class="row">
        @foreach($students as $student)
            <div class="m-2">
                <a class="card col-md-4 " href="{{ route('student.show', $student->id) }}"
                   style="text-decoration:none; color:black; max-width: 255px; margin: auto;">
                    <div class="card-header mt-3 p-0">
                        <img src="{{ asset('public/storage/'.$student->image) }}"
                             width="225px" height="200px" alt="">
                    </div>
                    <div class="card-body">
                        <p>Name: {{ $student->name }}</p>
                        <p>Class: {{ $student->class }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    @else
        <p class="alert alert-info">No Students found...</p>
    @endif
@endsection

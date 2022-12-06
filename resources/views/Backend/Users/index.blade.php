@extends('backend.layouts.layout')

@section('content')
    @if(Session::has('status'))
        <div class="alert alert-success">
            <h4>{{Session::get('status')}}</h4>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Users Section</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('user.create')}}" type="button"
                   class="btn btn-sm btn-outline-primary">Add New User</a>
            </div>
        </div>
    </div>

    @if(!$users->isEmpty())
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Profile Image</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Delete</th>
                    <th>Show</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>
                            <img src="{{asset('public/storage/'.$user->image)}}" alt=""
                                 width="50" height="40">
                        </td>
                        <td>{{ $user->postal_code }}, {{$user->address}}, {{$user->city}}, {{ $user->country }}</td>

                        <td>{{$user->role}}</td>
                        <td>
                            <div class="btn-group" user="group" aria-label="Basic example">
                                <form class="m-0" action="{{route('user.destroy', $user->id)}}" method="POST">
                                    @csrf
                                    @method('DElETE')
                                    <button type="submit" class="btn btn-link pl-0">Delete</button>
                                </form>
                            </div>
                        </td>
                        <td><a href="{{route('user.show', $user->id)}}" class="btn btn-link pl-0">Show</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <tr>
                <td colspan="11">

                </td>
            </tr>
        </div>
    @else
        <p class="alert alert-info">No users Record found...</p>
    @endif
@endsection

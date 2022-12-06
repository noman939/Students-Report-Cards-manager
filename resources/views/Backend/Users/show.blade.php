@extends('backend.layouts.layout')

@section('content')
    @if(Session::has('status'))
        <div class="alert alert-success">
            <h4>{{Session::get('status')}}</h4>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Users Section</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>User Info</h4>
            <div class="float-right btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{route('users.index')}}" type="button"
                       class="btn btn-sm btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Fist Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Email address</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Adress</label>
                                    <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">City</label>
                                    <input type="text" name="city" class="form-control" value="{{ $user->city }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Country</label>
                                    <input type="text" name="country" class="form-control" value="{{ $user->country }}">
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control" value="{{ $user->postal_code }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="inputRole">Select Roles</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="{{$user->role}}">{{ $user->role }}</option>
                                    @foreach($values as $role)
                                        <option value="{{$role}}">
                                            {{$role}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="students" class="col-form-label">{{ __('Assign Students') }}</label>
                                <select name="students[]" id="students" multiple class="form-control">
                                    <option value="default">Assign Students</option>
                                    @foreach($students as $student)
                                        <option value="{{$student->id}}" @if(in_array($student->id, $user->students->pluck('id')->toArray()))
                                            {{"selected"}} @endif>{{$student->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="card-avatar" style="justify-content: center; display: grid">
                            <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 200px;
                                                    height: 200px; border-radius: 100%;" src="{{ asset('public/storage/'.$user->image)  }}" />
                        </div>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#role').select2();

        $('#students').select2({
            multipel:true
        });
    </script>
@endsection

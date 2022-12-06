@extends('backend.layouts.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Users Section</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Create User</h4>
            <div class="float-right btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{route('users.index')}}" type="button"
                       class="btn btn-sm btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}">
                    @csrf

                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="name" class="col-form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="phone" class="col-form-label">{{ __('Phone Number') }}</label>
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="col-form-label">{{ __('Address') }}</label>
                            <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="city" class="col-form-label">{{ __('City') }}</label>
                            <input id="city" type="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">

                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="country" class="col-form-label">{{ __('Country') }}</label>
                            <input id="country" type="country" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country">

                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-4">
                            <label for="postal_code" class="col-form-label">{{ __('Postal Code') }}</label>
                            <input id="postal_code" type="postal_code" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code">

                            @error('postal_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="role" class="col-form-label">{{ __('Role') }}</label>
                            <select name="role" id="role" class="form-control">
                                <option value="default">Select Roles</option>
                                @foreach($values as $role)
                                    <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="students" class="col-form-label">{{ __('Assign Students') }}</label>
                            <select name="students[]" id="students" multiple class="form-control">
                                <option value="default">Assign Students</option>
                                @foreach($students as $student)
                                    <option value="{{$student->id}}">{{$student->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="password" class="col-form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
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

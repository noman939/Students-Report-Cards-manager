@extends('backend.layouts.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Students Section</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Create Student</h4>
            <div class="float-right btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{route('students.index')}}" type="button"
                       class="btn btn-sm btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="roll_no">{{ __('Roll Number') }}</label>
                        <input id="roll_no" type="text" class="form-control @error('roll_no') is-invalid @enderror" name="roll_no" value="{{ old('roll_no') }}" required autocomplete="roll_no">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 mb-2">
                        <label for="class">{{ __('Class') }}</label>
                        <input id="class" type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class') }}" required autocomplete="class">

                        @error('class')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="teachers">{{ __('Assign Teachers') }}</label>
                        @foreach($teachers as $teacher)
                            <div class="ml-2">
                                <input class="form-check-input" type="checkbox" name="teachers[]" id="teachers" value="{{ $teacher->id }}">
                                <label class="form-check-label" for="inlineCheckbox1">{{ $teacher->name }}</label>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-md-6 mb-2">
                    <label for="files">{{ __('Attachments') }}</label>
                    <input type="file" class="form-control form-control-file" multiple name="files[]" id="files">
                </div>

                <div class="col-md-6 mb-2">
                    <label for="image">{{ __('Image') }}</label>
                    <input type="file" class="form-control form-control-file" name="image" id="image">
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
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

        $('#teachers').select2({
            multipel:true
        });
    </script>
@endsection

@extends('backend.layouts.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Create Report</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Students</label>
                        <select name="student_id" id="student" class="form-control">
                            <option value="default">Select Student</option>
                            @foreach($students as $student)
                                <option value="{{$student->id}}">{{$student->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Experience</label>
                        <select name="experience" id="experience" class="form-control">
                            <option value="default">Select Status</option>
                            @foreach($values as $experience)
                                <option value="{{$experience}}">{{$experience}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="comments">Comment</label>
                        <textarea class="form-control" name="comments" id="comments" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control date" id="date" name="date">
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="files">{{ __('Attachments') }}</label>
                    <input type="file" class="form-control form-control-file" multiple name="files[]" id="files">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $('#student').select2();

        $('#experience').select2();

        $('#regions').select2({
            multipel:true
        });
        $('#date').datepicker({
            autoclose: true,
            dateFormat: "dd/mm/yyy"
        });
    </script>

@endsection

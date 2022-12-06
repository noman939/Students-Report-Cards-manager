@extends('backend.layouts.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit/Update Report</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('report.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Student Name</label>
                        <input type="text" class="form-control" disabled value="{{ $report->student->name }}">
                        <input type="hidden" name="student_id" value="{{ $report->student->id }}">
                    </div>
                    <div class="col-md-6">
                        <label for="">Experience</label>

                        <select name="experience" id="experience" class="form-control">
                            <option value="default">{{ $report->experience }}</option>
                            @foreach($values as $experience)
                                <option value="{{$experience}}">{{$experience}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="comments">Comment</label>
                        <textarea class="form-control" name="comments" id="comments" cols="30" rows="10">{{ $report->comments }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" value="{{ $report->date }}">
                    </div>
                </div>
                <div class="col-md-6 p-3 attachments">
                    <label for="">Attachments</label>
                    <div class="pl-3 row">
                        @foreach($attachments as $file)
                            <div class="attach_file">
                                <input type="hidden" class="file_id" value="{{ $file->id }}">
                                @if(pathinfo($file->path, PATHINFO_EXTENSION) == 'docx')
                                    <file src="{{asset($file->file)}}">{{ $file->file }}</file>
                                    <i onclick="deleteAttachments(this)" class="p-0 fa fa-times-circle position-absolute btn btn-link delete-img"
                                       style="margin-left: -20px; margin-top: 0px; font-size: 20px; color: #ff000091;"></i>
                                @else
                                    <img src="{{asset($file->file)}}"
                                         class="m-1" alt="" width="70" height="60"/>
                                    <i onclick="deleteAttachments(this)" class="p-0 fa fa-times-circle position-absolute btn btn-link delete-img"
                                       style="margin-left: -20px; margin-top: 0px; font-size: 20px; color: #ff000091;"></i>
                                @endif

                            </div>
                        @endforeach
                    </div>
                    <input type="file" class="form-control" name="files[]" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#student').select2();

        $('#experience').select2();
        function deleteAttachments(e){
            var attachment_id = $(e).closest('.attach_file').find('.file_id').val();

            $(e).closest('.attach_file').remove();
            $.ajax({
                method:"POST",
                url: "{{route('delete_attachment')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    'attachment_id':attachment_id,
                },
                success: function(response){
                    $(e).closest('.attachments').html();
                },
                error: function(response){

                }
            });

        }

    </script>
@endsection

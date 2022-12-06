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
            <form method="POST" action="{{ route('student.update', $student->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $student->name }}">

                    </div>
                    <div class="col-md-6">
                        <label for="roll_no">{{ __('Roll Number') }}</label>
                        <input id="roll_no" type="text" class="form-control" name="roll_no" value="{{ $student->roll_no }}">

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 mb-2">
                        <label for="class">{{ __('Class') }}</label>
                        <input id="class" type="text" class="form-control" name="class" value="{{ $student->class }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="teachers">{{ __('Assign Teachers') }}</label>

                        @foreach($teachers as $teacher)
                            <div class="ml-2">
                                <input class="form-check-input" type="checkbox" name="teachers[]" id="teachers" @if(in_array($teacher->id, $student->teachers->pluck('id')->toArray())) {{ "checked" }} @endif value="{{ $teacher->id }}">
                                <label class="form-check-label" for="inlineCheckbox1">{{ $teacher->name }}</label>
                            </div>
                        @endforeach
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
                <div class="col-md-4 mt-4">
                    <div class="card-avatar" style="justify-content: center; display: grid">
                        <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 200px;
                        height: 200px; border-radius: 100%;" src="{{ asset('public/storage/'.$student->image)  }}" />
                    </div>
                    <input type="file" name="image" class="form-control">
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
        // $('#role').select2();

        // $('#teachers').select2({
        //     multipel:true
        // });

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

@extends('backend.layouts.layout')

@section('content')
    @if(Session::has('status'))
        <div class="alert alert-success">
            <h4>{{Session::get('status')}}</h4>
        </div>
    @endif
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Reports Section</h2>
        @if(Auth::user()->role == "Super Admin" || Auth::user()->role == "Teacher")
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{route('report.create')}}" type="button"
                       class="btn btn-sm btn-outline-primary">Add New Report</a>
                </div>
            </div>
        @endif
    </div>

    <h3>Calendar</h3>

    <div id='calendar'></div>

    <!-- Modal -->

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold" id="title">Modal Header</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body col-md-12">
                    <p id="remarks" class="font-weight-normal"></p>
                    <strong id="status"></strong>
                    <h5 class="font-weight-bold">Attachments</h5>
                    <div class="attachments" id="attachments">

                    </div>
                </div>
                <div class="modal-footer comments_list" style="display: inline;">
                    <div class="row show_comment" id="show_comment">

                    </div>

                    <form class="inserted_comment" id="modalForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row insert">
                            <div class="col-md-9 form-group">
                                <input type="hidden" class="report_id" name="report_id" value="">
                                <input type="text" name="comment" id="insert_comment" class="form-control" placeholder="Enter Your Comment" require="required">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-primary" type="submit" value="Submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>

        $(document).ready(function () {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: [
                        @foreach($reports as $report)
                    {
                        title: '{{ $report->student->name }}',
                        start: '{{ $report->date }}',
                        @if($report->experience == "Excellent")
                        color: '#007a0a',
                        @elseif($report->experience == "Very Good")
                        color: '#0d78d6',
                        @elseif($report->experience == "Good")
                        color: '#f2fa0a',
                        @elseif($report->experience == "Poor")
                        color: '#f5882a',
                        @elseif($report->experience == "Absent")
                        color: '#de1009',
                        @endif
                        _fetchId: '{{ $report->id }}'
                    },
                    @endforeach
                ],
                eventClick: function (event) {
                    var report_id = event._fetchId;
                    $.ajax({
                        method: "POST",
                        url: "{{route('show_report')}}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            'report_id': report_id,
                        },
                        success: function (response) {
                            $('#myModal').modal('show');
                            $('#title').html(response.name).show();
                            $('#remarks').html(response.remarks).show();
                            $('#status').html(response.status).show();
                            $('.report_id').val(response.id).show();
                            $('#show_comment').html('');
                            $.each(response.comments, function(key, val) {
                                var date = val.created_at;
                                var content='<div class="col-md-12"><div class="media">' +
                                    '<div class="media-body">' +
                                    '<img src="http://localhost/student-management/public/storage/'+val.user.image+'" style="width: 30px; height: 30px; border-radius: 9999px !important;" alt="">' +
                                    '<span class="user_name ml-2">'+val.user.name+'</span>' +
                                    '<span class="badge badge-secondary ml-2">'+ date +'</span>' +
                                    '<span class="badge badge-secondary date"></span><p class="user_comment mt-2" id="user_comment">'+val.comment+'</p></div>' +
                                    '</div></div>';
                                $('#show_comment').append(content);
                            });

                            $("#attachments").html('');
                            $.each(response.attachments, function (key, attachment) {
                                var attach = '<img src="http://localhost/student-management/'+ attachment.file +'" class="m-1" alt="" width="70" height="60"/> ' +
                                '<i onclick="deleteAttachments(this)" class="p-0 fa fa-times-circle position-absolute btn btn-link delete-img" ' +
                                    'style="margin-left: -20px; margin-top: 0px; font-size: 20px; color: #ff000091;"></i>';
                                $("#attachments").append(attach);
                            });
                        },
                        error: function (response) {

                        }
                    })
                }
            });
        });


        $('#modalForm').submit(function (event) {
            event.preventDefault();
            let data = new FormData(document.getElementById("modalForm"));
            $.ajax({
                processData: false,
                contentType: false,
                data: data,
                type: "post",
                dataType: 'json',
                url: "{{ route('store_comment') }}",
                success: function (response) {
                    $("#user_comment").html(response.comment);
                },
            });
        });

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

        {{--$('#modalForm').submit(function (e) {--}}
        {{--    let report_id = $('.report_id').val();--}}
        {{--    let comment = $('#insert_comment').val();--}}
        {{--    $.ajax({--}}
        {{--        type: "post",--}}
        {{--        url: "{{route('store_comment')}}",--}}
        {{--        data: {--}}
        {{--            _token: "{{ csrf_token() }}",--}}
        {{--            'report_id': report_id,--}}
        {{--            'comment': comment,--}}
        {{--        },--}}
        {{--        success: function (response) {--}}
        {{--            // $("#image").img(response.profile);--}}
        {{--            // $("#user_comment").html(response.comment);--}}
        {{--            // $("#user_name").html(response.user_name);--}}
        {{--        },--}}
        {{--        error: function (response) {--}}

        {{--        }--}}
        {{--    })--}}
        {{--});--}}

    </script>

    {{--    url : '{{ route('report.show', $report->id) }}',--}}
    {{--    @if(!$reports->isEmpty())--}}
    {{--        <div class="table-responsive">--}}
    {{--            <table class="table table-striped table-sm">--}}
    {{--                <thead>--}}
    {{--                <tr>--}}
    {{--                    <th>Id</th>--}}
    {{--                    <th>Student Name</th>--}}
    {{--                    <th>Date</th>--}}
    {{--                    <th>Comments</th>--}}
    {{--                    <th>Experience</th>--}}
    {{--                    <th>Edit</th>--}}
    {{--                    <th>Delete</th>--}}
    {{--                </tr>--}}
    {{--                </thead>--}}
    {{--                <tbody>--}}
    {{--                @foreach($reports as $report)--}}
    {{--                    <tr>--}}
    {{--                        <td>{{$report->id}}</td>--}}
    {{--                        <td>{{$report->student->name}}</td>--}}
    {{--                        <td>{{$report->date}}</td>--}}
    {{--                        <td>{{$report->comments}}</td>--}}
    {{--                        <td>{{$report->experience}}</td>--}}
    {{--                        <td><a href="{{route('report.edit', $report->id)}}" class="btn btn-link pl-0">Edit</a></td>--}}
    {{--                        <td>--}}
    {{--                            <div class="btn-group" aria-label="Basic example">--}}
    {{--                                <form class="m-0" action="{{route('report.destroy', $report->id)}}" method="POST">--}}
    {{--                                    @csrf--}}
    {{--                                    @method('DElETE')--}}
    {{--                                    <button type="submit" class="btn btn-link pl-0">Delete</button>--}}
    {{--                                </form>--}}
    {{--                            </div>--}}
    {{--                        </td>--}}
    {{--                    </tr>--}}
    {{--                @endforeach--}}
    {{--                </tbody>--}}
    {{--            </table>--}}
    {{--        </div>--}}
    {{--        <div class="d-flex justify-content-center mt-3">--}}
    {{--            <tr>--}}
    {{--                <td colspan="11">--}}

    {{--                </td>--}}
    {{--            </tr>--}}
    {{--        </div>--}}
    {{--    @else--}}
    {{--        <p class="alert alert-info">No Report found...</p>--}}
    {{--    @endif--}}
@endsection

@section('script')


@endsection

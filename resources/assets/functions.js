$(document).ready(function(){
    $('.delete-cat').on('click', function(e){
        e.preventDefault();
        var cat_id = $(this).closest('.cat_list').find('.cat_id').val();

        var token = $('#csrf_token').attr('content');
        $(this).closest('.cat_list').remove();

        $.ajax({
            method:"POST",
            url: "/category/destroy",
            data: {
                _token: token,
                'id':cat_id,
            },
            success: function(response){
                swal('', response.status,'success');
            },
            error: function(response){

            }
        });
    });
});

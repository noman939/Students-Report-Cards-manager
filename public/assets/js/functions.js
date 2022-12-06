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

    // function deleteImage(name){
    //     alert('test');
    // }

    // $('.delete-img').on('click', function(e){
    //     e.preventDefault();
    //     var id = $(this).closest('.prod_img').find('.img_id').val();
    //     var token = $('#csrf_token').attr('content');
    //     $(this).closest('.prod_img').remove();
        
    //     $.ajax({
    //         method:"POST",
    //         url: "",
    //         data: {
    //             _token: token,
    //             'id':id,
    //         },
    //         success: function(response){
    //             $(this).closest('.product_images').html();
    //         },
    //         error: function(response){
                
    //         }
    //     });
    // });

});
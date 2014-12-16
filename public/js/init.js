$(document).ready(function() {
    // When someone posts
    $('#postForm').submit(function(event) {     
        $.ajax({
            url: '/posts/create',
            type: 'POST',
            dataType: 'JSON',
            data: $(this).serialize()
        })
        .done(function(data) {
            if (data.success == 'false') {
                $('.error').empty().append(data.message).slideDown(200).delay(3000).slideUp(250);
            } else {
                //$('.message').empty().append(data.message).slideDown(250).delay(3000).slideUp(250);
                $('#postForm')[0].reset();
                $(data.post_html).insertAfter('#postForm').hide().delay(100).slideDown(400);
                $('.no-posts').hide();
            }
        })

        event.preventDefault();
    });
});

    // The short polling process
    function getNewPosts() {
        if ($('.poster_memb .tab_post').length) {
            last_id = $('.poster_memb .tab_post').first().data('id');
            interval = 10000;
        } else {
            last_id = 0;
        }
        
        $.ajax({
            url: '/posts/latest/' + last_id,
            type: 'GET',
            dataType: 'JSON',
        })
        .done(function(data) {
            if (data) {
                if (data.is_new = 'true' && data.html) {
                    $('.no-posts').hide();
                    $(data.html).insertAfter('#postForm').hide().slideDown(500);    
                }
                
            }

            // Run the function every 10 seconds
            setTimeout(getNewPosts, 10000);
        })

    };
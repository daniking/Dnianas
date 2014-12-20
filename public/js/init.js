$(document).ready(function() {
    // When someone posts
    $('body').on('submit', '#postForm', function(event) {     
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

            // Map the div to array
            var ids = $('.poster_memb .tab_post').map(function() {

                // Get the ids and store them in this array
                return +$(this).data('id') || 0;
            });

            // Find the largest id from the ids array and set it to a variable
            last_id = Math.max.apply(Math, ids);
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

    // When a user presses 'enter' on the comment field
    $('body').on('keypress', '.comment-input', function(event) {        

        if (event.which == 13 && !event.shiftKey) {

            // Grab the post id and other inputs
            $post_id        = $(this).parents().get(3).dataset.id;
            $comment_input  = $('.comment-input').val();
            $token          = $('input[name=_token]').val();

            $.ajax({
                url: '/comment/create',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    text    : $comment_input,
                    _token  : $token,
                    post_id : $post_id
                }
            })
            .done(function(data) {
                $(data.html).insertBefore('.comment-insert');
            })

            // Reset the input field
            $(this).val('').blur();
        }
    });

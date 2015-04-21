var Dnianas = Dnianas || {};

var $loading    = $('#ajax-loader'),
token       = $('input[name=_token]').val(),
$body       = $('body');

// The default AJAX config.
$.ajaxSetup({
    type: 'POST',
    dataType: 'JSON',
});

// The Post object for posting related stuff.
Dnianas.Post = {

    init: function() {
        this.cache();
        this.bindEvents();
    },

    cache: function() {
        this.postForm = $('#postForm');
        this.likeButton = $('#likePost');
    },

    bindEvents: function() {
        this.postForm.on('submit' , this.createPost);
        this.likeButton.on('click', this.likePost);
    },

    createPost: function(event) {
        var self = Dnianas.Post;
        
        var request = $.ajax(
        {
            url: '/posts/create',
            data: $(this).serialize(),
            beforeSend: function() {
                $loading.show();
            },
            complete: function() {
                $loading.hide();
            }
        });

        request.done(function(data) {
            self.renderCreatedPost(data);
        });

        event.preventDefault();
    },

    renderCreatedPost: function(data) {
        if (data.success == 'false') {
            $('.error').empty().append(data.message).slideDown(100).delay(3000).slideUp(250);
        } else {
            this.postForm[0].reset();
            $(data.post_html).insertAfter(this.postForm).hide().delay(100).slideDown(400);
            $('.no-posts').hide();
        }
    },

    likePost: function() {
        var post_id = $(this).parents().get(2).dataset.id;
        var user_id  = $(this).parents().get(2).dataset.userid;
        var $postLike = $(this);
        var $postLikeEl = $postLike.children('#likeCount');
        var postLikeCount = $postLikeEl.data('count');

        console.log(postLikeCount);
    }

};

Dnianas.Post.init();

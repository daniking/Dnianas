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
    },

    bindEvents: function() {
        $body.on('submit', this.postForm, this.createPost);
    },

    createPost: function(event) {
        var self = Dnianas.Post;
        var data = {
            post_content: $(this).find('textarea').val(),
            _token: token
        };
        var request = $.ajax(
        {
            url: '/posts/create',
            data: data,
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
    }
};

Dnianas.Post.init();

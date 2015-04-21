var Dnianas = Dnianas || {};

var $loading = $('#ajax-loader'),
    token = $('input[name=_token]').val(),
    $body = $('body');

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
        $(document).on('submit', '#postForm', this.createPost);
        $(document).on('click', '#likePost', this.likePost);
    },

    createPost: function(event) {
        self = Dnianas.Post;

        var request = $.ajax({
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
        self = Dnianas.Post;
        likePostElement = $(this);
        post_id = $(this).parents().get(2).dataset.id;
        user_id = $(this).parents().get(2).dataset.userid;
        $postLikeEl = likePostElement.children('#likeCount');
        postLikeCount = $postLikeEl.data('count');

        var data = {
            post_id: post_id,
            user_id: user_id,
            like_count: postLikeCount,
            _token: token
        };

        var request = $.ajax({
            url: '/posts/like',
            data: data
        });

        request.done(function(data) {
            self.renderPostLike(data);
        });
    },

    renderPostLike: function(data) {
        if (data.like) {
            likePostElement.children('.likeIcon').addClass('liked');
            $postLikeEl.addClass('liked');
        } else {
            likePostElement.children('.likeIcon').removeClass('liked');
            $postLikeEl.removeClass('liked');
        }
        $postLikeEl.text(data.like_count);
    },

    getNewPosts: function() {
        var $postEl = $('.poster_memb .tab_post');
        var self    = Dnianas.Post;
        if ($postEl.length) {
            var ids = $postEl.map(function() {
                return +$(this).data('id') || 0;
            });

            var last_id = Math.max.apply(Math, ids);
        } else {
            last_id = 0;
        }

        var request = $.ajax({
            url: '/posts/latest/' + last_id,
            type: 'GET',
            dataType: 'JSON'
        });
        
        request.done(function(data) {
            self.renderLatestPost(data);
        });
    },

    renderLatestPost: function(data) {
        if (data) {
            if (data.is_new = 'true' && data.html) {
                $('.no-posts').hide();
                $(data.html).insertAfter('#postForm').hide().slideDown(500);
            }
        }
        // Run the function every 10 seconds.
        setTimeout(this.getNewPosts, 10000);
    }
};


Dnianas.Post.init();
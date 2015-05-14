Dnianas.Post = {

    init: function () {
        this.cache();
        this.bindEvents();
    },

    cache: function () {
        this.postForm = $('#postForm');
        this.likeButton = $('#likePost');
    },

    bindEvents: function () {
        $(document).on('submit', '#postForm', this.createPost);
        $(document).on('click', '#likePost', this.likePost);
    },

    createPost: function (event) {
        var request = $.ajax({
            url: '/posts/create',
            data: $(this).serialize(),
            beforeSend: function () {
                $loading.show();
            },
            complete: function () {
                $loading.hide();
            }
        });

        request.done(function (data) {
            Dnianas.Post.renderCreatedPost(data);
        });

        event.preventDefault();
    },

    renderCreatedPost: function (data) {
        if (data.success == 'false') {
            $('.error').empty().append(data.message).slideDown(100).delay(3000).slideUp(250);
        } else {
            this.postForm[0].reset();
            $(data.post_html).insertAfter(this.postForm).hide().delay(100).slideDown(400);
            $('.no-posts').hide();
        }
    },

    likePost: function () {
        var $likePostEl = $(this);
        var postLikeCount = $likePostEl.children('.likeCount').data('count');

        // Data for the AJAX request.
        var post_id = $likePostEl.parents('.tab_post').data('id');
        var user_id = $likePostEl.parents('.tab_post').data('userid');

        var request = $.ajax({
            url: '/posts/like',
            data: {     
                post_id: post_id,
                user_id: user_id,
                like_count: postLikeCount,
                _token: token
            }
        });

        request.done(function (data) {
            Dnianas.Post.renderPostLike(data, $likePostEl);
        });
    },

    renderPostLike: function (data, $postEl) {
        var $likeCountEl = $postEl.children('.likeCount');
        var $likeIconEl = $postEl.children('.likeIcon');

        // Toggle the class based on a boolean result from the server.
        $postEl.toggleClass('liked', data.like);
        $likeIconEl.toggleClass('liked', data.like);

        // Update the like count.
        $likeCountEl.text(data.like_count);
    },

    getMaxId: function($element) {
        // Filter through the ids
        var ids = $element.map(function () {
            return +$(this).data('id') || 0;
        });

        // Get the highest id attribute
        var last_id = Math.max.apply(Math, ids);

        // Return the maximum id.
        return last_id;
    },

    getNewPosts: function () {
        var $postEl = $('.poster_memb .tab_post');
        var last_id = 0;

        // If there was posts.
        if ($postEl.length > 0) {
            last_id = Dnianas.Post.getMaxId($postEl);
        }

        var request = $.ajax({
            url: '/posts/latest/' + last_id,
            type: 'GET',
            dataType: 'JSON'
        });

        request.done(function (data) {
            Dnianas.Post.renderLatestPost(data);
        });
    },

    renderLatestPost: function (data) {
        if (data && data.is_new == 'true' && data.html) {
            $('.no-posts').hide();
            $(data.html).insertAfter('#postForm').hide().slideDown(500);
        }

        // Run the function every 10 seconds.
        setTimeout(this.getNewPosts, 10000);
    }
};
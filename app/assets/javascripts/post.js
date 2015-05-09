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
        var self = Dnianas.Post;

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
            self.renderCreatedPost(data);
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
        self = Dnianas.Post;
        $likePostEl = $(this);
        $postLikeCountEl = $likePostEl.children('#likeCount');
        postLikeCount = $postLikeCountEl.data('count');

        var data = {
            post_id: $likePostEl.parents().get(2).dataset.id,
            user_id: $likePostEl.parents().get(2).dataset.userid,
            like_count: postLikeCount,
            _token: token
        };

        var request = $.ajax({
            url: '/posts/like',
            data: data
        });

        request.done(function (data) {
            self.renderPostLike(data);
        });
    },

    renderPostLike: function (data) {
        if (data.like) {
            $likePostEl.children('.likeIcon').addClass('liked');
            $postLikeCountEl.addClass('liked');
        } else {
            $likePostEl.children('.likeIcon').removeClass('liked');
            $postLikeCountEl.removeClass('liked');
        }
        $postLikeCountEl.text(data.like_count);
    },

    getNewPosts: function () {
        var self = Dnianas.Post;
        var ids = [];
        var $postEl = $('.poster_memb .tab_post');
        last_id = 0;

        if ($postEl.length) {

            // Filter through the ids
            ids = $postEl.map(function () {
                return +$(this).data('id') || 0;
            });

            // Get the highest id attribute
            last_id = Math.max.apply(Math, ids);
        }

        var request = $.ajax({
            url: '/posts/latest/' + last_id,
            type: 'GET',
            dataType: 'JSON'
        });

        request.done(function (data) {
            self.renderLatestPost(data);
        });
    },

    renderLatestPost: function (data) {
        if (data) {
            if (data.is_new == 'true' && data.html) {
                $('.no-posts').hide();
                $(data.html).insertAfter('#postForm').hide().slideDown(500);
            }
        }

        // Run the function every 10 seconds.
        setTimeout(this.getNewPosts, 10000);
    }
};
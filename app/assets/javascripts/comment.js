Dnianas.Comment = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        $(document).on('keypress', '.comment-input', this.comment);
    },

    comment: function () {
        self = Dnianas.Comment;

        if (event.which == 13 && !event.shiftKey) {

            post_id = $(this).parents().get(3).dataset.id;
            user_id = $(this).parents().get(3).dataset.userid;
            $comment_input = $(this);

            var request = $.ajax({
                url: '/comment/create',
                data: {
                    text: $comment_input.val(),
                    _token: token,
                    post_id: post_id,
                    user_id: user_id,
                }
            });

            request.done(function (data) {
                self.renderCreatedComment(data);
            });

            $(this).val('').blur();
        }

    },

    renderCreatedComment: function (data) {
        $(data.html).insertBefore($comment_input.parent());
    }

};
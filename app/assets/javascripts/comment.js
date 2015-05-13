Dnianas.Comment = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        $(document).on('keypress', '.comment-input', this.comment);
    },

    comment: function () {                
        if (event.which == 13 && !event.shiftKey) {
            var $commentInput = $(this);

            var post_id = $commentInput.parents('.tab_post').data('id');
            var user_id = $commentInput.parents('.tab_post').data('userid');

            var request = $.ajax({
                url: '/comment/create',
                data: {
                    text: $commentInput.val(),
                    _token: token,
                    post_id: post_id,
                    user_id: user_id,
                }
            });

            request.done(function (data) {
                Dnianas.Comment.renderCreatedComment(data, $commentInput);
            });

            // Reset the commment input.
            $(this).val('').blur();
        }

    },

    renderCreatedComment: function (data, $commentInput) {
        $(data.html).insertBefore($commentInput.parent());
    }

};
Dnianas.User = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        $(document).on('click', '#followBtn', this.follow);
        $('#followBtn').hover(this.hoverIn, this.hoverOut);
    },

    follow: function () {
        var $followBtn = $(this);
        var profileId = $followBtn.data('profile-id');

        var request = $.ajax({
            url: '/follow',
            data: {
                profile_id: profileId,
                _token: token
            }
        });

        request.done(function(data) {
            Dnianas.User.renderFollow(data, $followBtn);
        });
    },

    renderFollow: function(data, $followBtn) {
        if (data.follow) {
            $followBtn.addClass('following');
            $followBtn.text('Unfollow');
            $followBtn.data('action', 'unfollow')
        } else {
            $followBtn.removeClass('following');
            $followBtn.text('Follow');
            $followBtn.data('action', 'follow')
        }
    },

    hoverIn: function() {
        $followBtn = $(this);

        // If it is a follow button
        if($followBtn.data('action') == 'follow') {
            $followBtn.css('background', '#497AC9');
        } else {
            $followBtn.text('Unfollow');
            $followBtn.css('background', '#FC6262');
        }
    },
    
    hoverOut: function() {
        if ($followBtn.data('action') == 'follow') {
            $followBtn.text('Follow');
            $followBtn.css('background', '');
        } else if ($followBtn.data('action') == 'unfollow') {
            $followBtn.text('Following');
            $followBtn.css('background', '');
        }
    }
}
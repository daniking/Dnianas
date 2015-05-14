Dnianas.Notification = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        $(document).on('click', '#opennotifii', this.markAsRead);
    },

    countNotifications: function () {
<<<<<<< HEAD
        var $notifications = $('.boxnotificationsusers').children().find('.boxsendnotifi');
=======
        var zzz$notifications = $('.boxnotificationsusers').children().find('.boxsendnotifi');
>>>>>>> c96a3857a13903459af557f6f0a7acc4f5b11a17
        var ids = [];

        // Add unread notifications to the ids array.
        $notifications.each(function () {
            if ($(this).data('read') === 0) {
                ids.push($(this).data('id'));
            }
        });

        return ids;
    },

    markAsRead: function () {
        // Count the notifications.
        var ids = Dnianas.Notification.countNotifications();

        // If there were notifications, then mark them as read.
        if (ids.length > 0) {
            var request = $.ajax({
                url: '/notifications/read',
                data: {
                    notifications: ids,
                    _token: token
                }
            });

            request.done(function (data) {
                Dnianas.Notification.renderNotificationCount(data);
            });
        }
    },

    renderNotificationCount: function (data) {
        var $notification = $('#opennotifii');
        if (data.seen) {
            $notification.find('.not_nu1').fadeOut(200);
        }
    }
};
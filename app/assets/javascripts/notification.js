Dnianas.Notification = {
    init: function () {
        this.bindEvents();
        this.cache();
    },

    bindEvents: function () {
        $(document).on('click', '#opennotifii', this.markAsRead);
    },

    cache: function () {
        $notification = $('#opennotifii');
    },

    countNotifications: function () {
        var $notifications = $('.boxnotificationsusers').children().find('#boxsendnotifi');
        ids = [];

        // Add unread notifications to the ids array.
        $notifications.each(function () {
            if ($(this).data('read') === 0) {
                ids.push($(this).data('id'));
            }
        });

        return ids;
    },

    markAsRead: function () {
        self = Dnianas.Notification;
        ids = self.countNotifications();

        if (ids.length > 0) {
            var request = $.ajax({
                url: '/notifications/read',
                data: {
                    notifications: ids,
                    _token: token,
                }
            });

            request.done(function (data) {
                self.renderNotificationCount(data);
            });
        }
    },

    renderNotificationCount: function (data) {
        if (data.seen) {
            $notification.find('.not_nu1').fadeOut(200);
        }
    }
};
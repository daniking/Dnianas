<?php 

class NotificationController extends BaseController
{
    public function read()
    {
        // Get the ids
        $ids = Input::get('notifications');

        // Get the notifications
        $notifications = Notification::whereIn('id', $ids);

        // Update the notificatoin seen status.
        $notifications->update(['seen' => 1]);

        return Response::json([
            'seen' => true
        ]);
    }
}
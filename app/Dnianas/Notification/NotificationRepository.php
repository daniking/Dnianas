<?php 
namespace Dnianas\Notification;

use \Notification;

class NotificationRepository 
{   
    /**
     * Get notifications for provided user
     * @var $user The user you want to get the notifications for.
    */
    public function latest(\User $user)
    {
        $notifications = Notification::with('sender')
        ->where('recipient_id', $user->id)
        ->where('sender_id', '!=', $user->id)
        ->latest()
        ->get();

        return $notifications;
    }

    /**
     * Send the notification to the user.
     * @param  $sender_id           The sender of that notification
     * @param  $recipient_id        The recipient of that notification
     * @param  $object_id           The id of that object
     * @param  $object_type         The object type (post, user, photo...)
     * @param  notification_type    The notification type (like, follow, message)
     * @return collection
     */
    public function send($sender_id, $recipient_id, $object_id, $object_type, $notification_type)
    {
        Notification::firstOrCreate([
            'sender_id' => $user->id,
            'recipient_id' => $profile_id,
            'object_id' => $profile_id,
            'object_type' => 'User',
            'notification_type' => 'Follow',
            'seen' => 0,
        ]);
    }
}
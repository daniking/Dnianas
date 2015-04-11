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
}
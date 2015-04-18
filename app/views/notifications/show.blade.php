<span class="text-top" id="opennotifii">
    Notifications
    @if($notificationCount && $notificationCount->count())
        <span class="not_nu1">{{ $notificationCount->count() }}</span>
    @endif
</span>
<div id="_whnb12">
    <div class="boxnotifi _12nca">
        <span class="_212xls"></span>
        <div id="headernotifitop">
            <h2>Notifications</h2>
        </div>
        <div class="boxnotificationsusers">
            @foreach($notifications as $notification)
                <a href="/">
                    @if($notification->seen == 0)
                        <div id="boxsendnotifi" class="unread" data-id="{{ $notification->id }}" data-read="0">
                    @else
                        <div id="boxsendnotifi" data-id="{{ $notification->id }}">
                    @endif
                        <img src="{{ profile_picture($notification->sender) }}" id="picnotifishow">
                        <span id="namenotifishow">{{ $notification->sender->first_name }}
                            @if($notification->notification_type == 'Like')
                                <span id="textnotifishow">likes your status.</span>
                            @elseif($notification->notification_type == 'Follow')
                                <span id="textnotifishow">followed you.</span>
                            @elseif($notification->notification_type == 'Comment')
                                <span id="textnotifishow">commented on your post.</span>
                            @endif
                            <div class="notification-time" data-livestamp="{{ format_date($notification->updated_at) }}"></div>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
        <div id="footernotifitop"></div>
    </div>
</div>

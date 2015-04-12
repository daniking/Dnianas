<span class="text-top" id="opennotifii">
    Notifications
    @if($notifications && $notifications->count() )
        <span class="not_nu1">{{ $notifications->count() }}</span>
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
                <div id="boxsendnotifi">
                    <img src="{{ profile_picture($notification->sender) }}" id="picnotifishow">
                    <span id="namenotifishow">{{ $notification->sender->first_name }}
                        @if($notification->notification_type == 'Like')
                            <span id="textnotifishow">likes your status.</span>
                        @elseif($notification->notification_type == 'Follow')
                            <span id="textnotifishow">followed you.</span>
                        @elseif($notification->notification_type == 'Comment')
                            <span id="textnotifishow">commented on your post.</span>
                        @endif
                    </span>
                </div>
            @endforeach
        </div>
        <div id="footernotifitop"></div>
    </div>
</div>

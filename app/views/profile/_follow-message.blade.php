    
@if(Auth::user()->id !== $user->id)
    <button class="bot_sasda22131" id="openmsg">
        <span>Messages</span>
    </button>
@if($user->isFollowedBy(Auth::user(), $user->id))
    <button class="bot_sasda22131 following" id="followBtn" data-action="unfollow" data-profile-id="{{ $user->id }}">
        <span>Following</span>
    </button>
@else 
    <button class="bot_sasda22131" id="followBtn" data-action="follow" data-profile-id="{{ $user->id }}">
        <span>Follow</span>
    </button>
@endif
@endif
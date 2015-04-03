<div class="comment-wrapper">                        
    <div class="comments">
        @if($post->comments)
            @foreach($post->comments as $comment)
                <div class="comment">
                    <img src="{{ profile_picture($comment->user) }}" class="profile-picture">
                    {{ link_to_route('profile.show', $comment->user->fullName(), $comment->user->username, ['class' => 'comment-name']) }}
                    <div class="comment-text">{{{ $comment->text }}}</div>
                    <div class="posted-date" data-livestamp="{{ format_date($comment->posted_date) }}"></div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="comment-insert">
        <img src="{{ profile_picture(Auth::user()) }}" alt="Profile Picture" class="profile-picture">
        <textarea  dir="ltr" class="comment-input" placeholder="Write something..."></textarea>
    </div>
</div>
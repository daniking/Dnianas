<div class="comment-wrapper">                        
    <div class="comments">
        @if($post->comments)
            @foreach($post->comments as $comment)
                <div class="comment">
                    <img src="photo/pro.jpg" class="profile-picture">
                    <a href="user/{{ $comment->user->username }}" class="comment-name">{{ $comment->fullName() }}</a>
                    <div class="comment-text">{{ $comment->text }}</div>
                    <div class="posted-date" data-livestamp="{{ formatDate($comment->posted_date) }}"></div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="comment-insert">
        <img src="photo/pro.jpg" alt="Profile Picture" class="profile-picture">
        <textarea  dir="ltr" class="comment-input" placeholder="Write something..."></textarea>
    </div>
</div>
</div>

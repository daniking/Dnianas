<div class="comment">
    <img src="photo/pro.jpg" class="profile-picture">
    <a href="user/{{ Auth::user()->username }}" class="comment-name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
    <div class="comment-text">{{ Input::get('text') }}</div>
    <div class="posted-date" data-livestamp="{{ formatDate(Carbon::now()) }}"></div>
</div>
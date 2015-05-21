<div class="comment">

    <img src="{{ profile_picture(Auth::user()) }}" class="profile-picture">
    <a href="user/{{ Auth::user()->username }}" class="comment-name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
    <div class="comment-text"><span class="comtext">{{{ Input::get('text') }}}</span></div>
    <div class="posted-date" data-livestamp="{{ format_date(Carbon::now()) }}"></div>
</div>
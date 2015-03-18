<div class="left11 _user11">
    <div class="cover_ho">
        <img src="{{ cover_photo(Auth::user()) }}">
    </div>
    <div class="profile_ho">
        <img src='{{ profile_picture(Auth::user()) }}'>
    </div>
    <div class="nam_ho">
        <h1>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
        <a href="">edit profile</a>
    </div>

    <div class="all_users_ho">
        <h1>Account</h1>
        <h2 class="lin">Followers<span>10m</span></h2>
        <h2>Following<span>1m</span></h2>
        @if($about && $about->count())
            <h2>Live in<span>{{$about->address}}</span></h2>
        @endif
        <a href="">Find Books</a>
        <a href="">Find Friends</a>
        <h1 class="account-user">Who To Follow</h1>
    </div>
</div>

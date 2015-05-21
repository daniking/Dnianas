<div class="left11 _user11">
    <div class="cover_ho">
        <img src="{{ cover_photo(Auth::user()) }}">
    </div>
    <div class="profile_ho">
        <img src='{{ profile_picture(Auth::user()) }}'>
    </div>
    <div class="nam_ho">
        <h1 class="nuleftsid">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </h1>
    </div>

    <div class="all_users_ho">
        <h1>Account</h1>
        <h2 class="lin">Followers<span>{{Auth::user()->followers->count() }}</span></h2>
        <h2>Following<span>{{ Auth::user()->following->count() }}</span></h2>
        @if($about && $about->count())
            <h2>Live in<span>{{$about->address}}</span></h2>
        @endif
        <a href="">Find Books</a>
        <a href="">Find Friends</a>
        <h1 class="account-user">Who To Follow</h1>
    </div>
</div>

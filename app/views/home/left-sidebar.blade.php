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
        <h1 class="titlusertxt">Account</h1>
        <h2 class="lin">Followers<span class="stttext">{{Auth::user()->followers->count() }}</span></h2>
        <h2>Following<span class="stttext">{{ Auth::user()->following->count() }}</span></h2>
        @if($about && $about->count())
            <h2>Live in<span class="stttext">{{$about->address}}</span></h2>
        @endif
        <a href="">Find Books</a>
        <a href="">Find Friends</a>
        <h1 class="titlusertxt _x1321">Who To Follow</h1>
        <div class="taguser _UsF33">
        <div class="tabfollow">
        <div class="imgfolow"><img src='{{ profile_picture(Auth::user()) }}' class="imgfolow_2"></div>
        <div class="UN_Folow">
        <h1 class="UNflow">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </h1>
         <h3 class="usfloadd">Live in<span>{{$about->address}}</span></h3>
        </div>
        
        <div class="botsflow"> <button class="bottoflow" data-action="follow">
       
    </button></div>

        </div>
        
        </div>
    </div>
</div>

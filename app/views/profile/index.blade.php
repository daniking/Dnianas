@include('template._partials.header')
@include('home.nav-top')
<div class="main_con_prof">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="cover11 _bord12" id="coversus">
            <img src="{{ cover_photo($user) }}">
            <div class="ri_messs_fo232">
                @include('profile._follow-message')
            </div>

        </div>
        <div class="prof-membpic">
            <br>
            <img src="{{ profile_picture($user) }}" class="profilpicusers">
            <br>
            <h1>{{ $user->fullName() }}</h1>
            <h2>Following<span>{{ $user->following()->count() }}</span></h2>
            <h2>Followers <span>{{ $user->followers()->count() }}</span></h2>
            <img src="/img/icons/sett.png" class="repotblock" id="opentargmore">
            <div class="moresectionuser">
                <b class="blo52re_12">Block</b>
                <b class="blo52re_12 lins_xl">Repo</b>
            </div>
        </div>

        @include('profile._top-bar')

        @include('profile._left-sidebar')
   </div>

    <div  id="user_hoprofily">
        @if( $user->id == Auth::user()->id )
            <div class="post-add" style="margin-left: 35px;">
                @include('home.post-add')
            </div>
        @endif
        
        @if($user->posts->count())
            @foreach($user->posts as $post)
                <div class="post">
                    @include('posts._post')
                </div>
            @endforeach
        @else 
            <div class="no-posts">This user has no posts</div>
        @endif
    </div>

@include('profile.message-box')

@include('template._partials.footer')
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


        <div class="ab_prof_mem">
            <div id="user_lin_192">
                <a href="" id="lf_lin_us" class="selc"><span>{{ $user->fullName()}}</span></a>
                <a href="" id="lf_lin_us" ><span>Photos</span></a>
                <a href="" id="lf_lin_us"><span>Books</span></a>
                <a href="" id="lf_lin_us"><span>About</span></a>
                <a href="" id="lf_lin_us"><span>Followers</span></a>
                <a href="" id="lf_lin_us"><span>Following</span></a>
            </div>
        </div>
        @include('profile._left-sidebar')
           <div  id="user_hoprofily">
                @if( $user->id == Auth::user()->id )
                    <div class="post-add" style="margin-left: 35px">
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

       </div>

   </div>
   <div class="logout_123" id="logoutacou">
    <div id="box_logout">
        <div class="title_box_log">
            <span>Are you sure you want to log out?</span></div>
            <button class="ui_buttonbtn_1" data-btn-id="0"><span>Cancel</span></button>
            <button class="ui_buttonbtn_2" data-btn-id="0"><span>Yes i want</span></button>
        </div>
    </div>

@include('profile.message-box')

@include('template._partials.footer')
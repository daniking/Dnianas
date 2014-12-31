@include('template._partials.header')
@include('home.nav-top')
<div class="main_con_prof">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="cover11 _bord12" id="coversus">
            <img src="/photo/cover.jpg">
            <div class="ri_messs_fo232">
                
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
            </div>

        </div>
        <div class="prof-membpic">
            <br>
            <img src="/photo/profile_picture.jpeg" class="profilpicusers">
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
        <div class="leftabot" id="memb_sos">
            <h1>About</h1>
            <h2>Live in <span>{{ $user->about->address }}</span></h2>
            <h2>Job Title<span>{{ $user->about->job_title }}</span></h2>
            <h2>Website <span>{{ $user->about->website }}</span></h2>

            <p class="text-about">About You</p>
            <p class="about-you" dir="ltr">
                {{ $user->about->about }}
           </div>
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



    <div id="message-box-hide">
        <div class="body-messg">
            <div id="send-mesg-user" class="scrols">
                <div id="img-cove-msg">
                <img src="/photo/cover.jpg" >
                </div>
                <div id="img-pro-msg">
                    <img src="/photo/profile_picture.jpeg" >
                </div>
                <h1 class="username-msg">Daniel Join</h1>
                <h1 class="send-msg-user">New Message</h1>
                <textarea class="msg-send"placeholder="Write a message..." ></textarea>
                <input type="submit" class="send" value="Send">
                <input type="submit" class="cancel" value="Cancel" id="clsoems">

            </div>
        </div>
    </div>
@include('template._partials.footer')
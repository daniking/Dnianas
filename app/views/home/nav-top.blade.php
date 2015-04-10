<div class="header _top11 _fixs">
    <div class="main_con_hea">
        <a class="logo" href="/"></a>
        <div class="search">
            <input type="text" class="search-peple" placeholder="Search People" >
            <input type="submit" class="search_submit" value="Search tags">
        </div>
        <div id="rig-ico-texts">
            <a href="{{ route('profile.show', Auth::user()->username) }}" class="text-top" id="hov_pic_shows">
                <img src="{{ profile_picture(Auth::user()) }}" id="picprosmall" /> {{ Auth::user()->first_name }}
            </a>
            <span class="text-top" id="opennotifii">Notifications
            <span class="not_nu1">250</span></span>
            <div id="_whnb12">
                <div class="boxnotifi _12nca">
                    <span class="_212xls"></span>
                    <div id="headernotifitop">
                        <h2>Notifications</h2>
                    </div>
                    <div class="boxnotificationsusers">
                        <div id="boxsendnotifi">
                            <img src="photo/dani-pro.jpg" id="picnotifishow">
                            <span id="namenotifishow">Nali W.Mahmood <span id="textnotifishow">Like This Photo</span></span>
                            <img src="photo/aren.jpg" class="innotifi" >
                        </div>
                        <div id="boxsendnotifi">
                            <img src="photo/dani-pro.jpg" id="picnotifishow">
                            <span id="namenotifishow">Akar Muhamad<span id="textnotifishow">Like This Photo</span></span>
                            <img src="photo/aren.jpg" class="innotifi" >
                        </div>
                    </div>
                    <div id="footernotifitop"></div>
                </div>
            </div>

            <a href="" class="text-top">Messages</a>
            <a href=""><img src="/img/icons/sett.png" class="icos"></a>
            <a href=""><img src="/img/icons/help.png" class="icos"></a>
            <span id="logout"><img src="/img/icons/off.png" class="icos"></span>
        </div>

    </div>

</div>
<div class="main_con">
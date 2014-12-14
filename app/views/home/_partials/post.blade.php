<div class="tab_post" id="users_shows" data-id="{{ $p->id }}">
                <div id="abo_users_po">
                    <img src="photo/pro.jpg" id="clicksows" >
                    <div class="hover_profile">

                        <img src="photo/dani-cov.jpg" class="small_cover">
                        <a href="profile.php">
                            <img src="photo/pro.jpg" class="small_profie">
                            <h1 class="users_small">{{ $p->user->first_name }} {{ $p->user->last_name }}</h1>

                        </a>
                    </div>
                    <span><a href="">{{ $p->user->first_name }} {{ $p->user->last_name }}</a></span>
                    <span class="data_post">{{ formatDate($p->posted_date) }}</span>

                </div>
                <br>
                <p> {{{ $p->post_content }}} </p>
                <br>
    
                <div class="place_com_li">
                    <button class="sc-bot-like _likes"><img src="img/icons/like.png"><span>0</span></button>
                    <button class="sc-bot-comm"><img src="img/icons/comments.png"><span>0</span></button>
                    <button class="sc-bot-repo"><img src="img/icons/repo.png"><span>0</span></button>
                    <button class="sc-bot-share"><img src="img/icons/share.png"><span>0</span></button>
                    <div id="titlelicomresh"></div>
                    <br>
                    <textarea name="" class="comment" placeholder="Write something..."></textarea>

                </div>
            </div>
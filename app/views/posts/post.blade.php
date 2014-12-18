<div class="tab_post" id="users_shows" data-id="{{ $post_id }}">
    <div id="abo_users_po">
        <img src="photo/pro.jpg" id="clicksows">
        <div class="hover_profile" style="display: none;">

            <img src="photo/dani-cov.jpg" class="small_cover">
            <a href="profile.php">
                <img src="photo/pro.jpg" class="small_profie">
                <h1 class="users_small"></h1>

            </a>
        </div>
        <span><a href="">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a></span>
        <span class="data_post" data-livestamp="{{ Carbon::now()->timestamp }}"></span>
    </div>
    <br>
    <p>{{{ Input::get('post_content') }}}</p>
    <br>
    <div class="place_com_li">
        <button class="sc-bot-like _likes"><img src="img/icons/like.png"><span>0</span></button>
        <button class="sc-bot-comm"><img src="img/icons/comments.png"><span>0</span></button>
        <button class="sc-bot-repo"><img src="img/icons/repo.png"><span>0</span></button>
        <button class="sc-bot-share"><img src="img/icons/share.png"><span>0</span></button>
        <div id="titlelicomresh" style="display: none;"></div>
        <br>
        <textarea  class="comment-input" placeholder="Write something..."></textarea>

    </div>
</div>
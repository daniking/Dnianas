<div class="tab_post" id="users_shows" data-id="{{ $post_id }}">
    <div id="abo_users_po">
        <img src="{{ profile_picture(Auth::user()) }}" id="clicksows">
        <span><a href="">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a></span>
        <span class="data_post" data-livestamp="{{ Carbon::now()->timestamp }}"></span>
    </div>
    <br>
    <p> {{  nl2br(e(Input::get('post_content'))) }} </p>
    <br>
    <div class="place_com_li">
        <div class="bar">
            <button class="sc-bot-like _likes" id="likePost">
                <span class="fa fa-star likeIcon"></span>
                <span id="likeCount">0</span>
            </button>
            <button class="sc-bot-comm">
                <span class="fa fa-comment commentIcon"></span>
                <span id="commentCount">0</span>
            </button>
        </div>
        <div id="titlelicomresh" style="display: none;"></div>
        <br>
        <div class="comment-wrapper">
            <div class="comment-insert">
                <img src="{{ profile_picture(Auth::user()) }}" alt="Profile Picture" class="profile-picture">
                <textarea  dir="ltr" class="comment-input" placeholder="Write something..."></textarea>
            </div>
        </div>
    </div>
</div>
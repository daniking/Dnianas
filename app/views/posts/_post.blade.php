    <div class="tab_post" id="users_shows" data-id="{{ $post->id }}">
        <div id="abo_users_po">
            <img src="/photo/profile_picture.jpeg" id="clicksows" >
            <div class="hover_profile">

                <img src="/photo/cover.jpg" class="small_cover">
                <a href="profile.php">
                    <img src="/photo/profile_picture.jpeg" class="small_profie">
                    <h1 class="users_small">{{ $post->user->first_name }} {{ $post->user->last_name }}</h1>
                </a>
            </div>
            <span><a href="" class="first">{{ $post->user->first_name }} {{ $post->user->last_name }}</a></span>
            <span class="data_post" data-livestamp="{{ formatDate($post->posted_date) }}"></span>
        </div>
        <br>
        <p> {{{ $post->post_content }}} </p>
        <br>
        <div class="place_com_li">
            <div class="bar">
                <button class="sc-bot-like" id="likePost">
                    @if($post->isLikedBy(Auth::user(), $post->id))
                        <span class="fa fa-star likeIcon liked"></span>
                        <span id="likeCount" class="liked">{{ $post->likes()->count() }}</span>
                    @else 
                        <span class="fa fa-star likeIcon"></span>
                        <span id="likeCount">{{ $post->likes()->count() }}</span>
                    @endif
                </button>
                <button class="sc-bot-comm">
                    <span class="fa fa-comment commentIcon"></span>
                    <span id="commentCount">{{ $post->comments()->count() }}</span>
                </button>
            </div>
            <div id="titlelicomresh"></div>
            <br>
            @include('posts._comment')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>
    </div>
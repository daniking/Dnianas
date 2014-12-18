<div class="tab_post" id="users_shows" data-id="{{ $post->id }}">
                <div id="abo_users_po">
                    <img src="photo/pro.jpg" id="clicksows" >
                    <div class="hover_profile">

                        <img src="photo/dani-cov.jpg" class="small_cover">
                        <a href="profile.php">
                            <img src="photo/pro.jpg" class="small_profie">
                            <h1 class="users_small">{{ $post->user->first_name }} {{ $post->user->last_name }}</h1>
                        </a>
                    </div>
                    <span><a href="">{{ $post->user->first_name }} {{ $post->user->last_name }}</a></span>
                    <span class="data_post" data-livestamp="{{ formatDate($post->posted_date) }}"></span>

                </div>
                <br>
                <p> {{{ $post->post_content }}} </p>
                <br>
    
                <div class="place_com_li">
                    <button class="sc-bot-like _likes"><img src="img/icons/like.png"><span>0</span></button>
                    <button class="sc-bot-comm"><img src="img/icons/comments.png"><span>0</span></button>
                    <button class="sc-bot-repo"><img src="img/icons/repo.png"><span>0</span></button>
                    <button class="sc-bot-share"><img src="img/icons/share.png"><span>0</span></button>
                    <div id="titlelicomresh"></div>
                    <br>
                    <div class="comment-wrapper">
                        

                        <img src="photo/pro.jpg" alt="Profile Picture" class="profile-picture">
                        <textarea  dir="ltr" class="comment-input" placeholder="Write something..."></textarea>
                    </div>
                    <div class="comments">
                        @if($post->comments)
                            @foreach($post->comments as $comment)
                                <div class="comment">
                                    <div>{{ $comment->user->first_name . ' ' . $comment->user->last_name }}</div>
                                    <div>{{ $comment->comment_content }}</div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
    <div class="tab_post" id="users_shows" data-id="{{ $post->id }}" data-userid="{{ $post->user->id}}">
    <div class="editabpo"><span  class="edtags">
    
    
    
    </span><div class="slideremovepost">
    <a href="#" class="HAlin"><span class="ED_x5">Edit Post</span></a>
      <a href="#" class="HAlin"><span class="ED_x5">Remove Post</span></a>
      <a href="#" class="HAlin _HAl2"><span class="ED_x5">Like Post</span></a>
    </div></div>
        <div id="abo_users_po">
            <img src="{{ profile_picture($post->user) }}" id="clicksows" >
            <div class="hover_profile">
                <a href="profile.php">
                    <img src="{{ profile_picture($post->user) }}" class="small_profie">
                    <h1 class="users_small">{{ $post->user->first_name }} {{ $post->user->last_name }}</h1>
                </a>
            </div>
            <span class="dnweb">{{ link_to_route('profile.show', $post->user->fullName(), $post->user->username) }}</span>
            <span class="data_post" data-livestamp="{{ format_date($post->posted_date) }}"></span>
        </div>
        <br>
        <div class="post-content"><span class="context"  >{{  nl2br(e($post->post_content)) }}</span></div>
        <br>
        <div class="place_com_li">
            <div class="bar">
                <button class="sc-bot-like" id="likePost">
                    @if($post->isLikedBy(Auth::user(), $post->id))
                        <span class="fa fa-star likeIcon liked"></span>
                        <span id="likeCount" class="liked" data-count="{{ $post->likes()->count() }}">{{ $post->likes()->count() }}</span>
                    @else 
                        <span class="fa fa-star likeIcon"></span>
                        <span id="likeCount" data-count="{{ $post->likes()->count() }}">{{ $post->likes()->count() }}</span>
                    @endif
                </button>
                <button class="sc-bot-comm">
                    <span class="fa fa-comment commentIcon"></span>
                    <span id="commentCount">{{ $post->comments()->count() }}</span>
                </button>
            </div>
            <div id="titlelicomresh"></div>
            @include('posts._comment')
        </div>
    </div>
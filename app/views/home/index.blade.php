@include('template._partials.header')
    @include('home.nav-top')
    @include('home.left-sidebar')
<div class="poster_memb">
    <div class="error" style="display:none"></div>
    <div class="message" style="display:none"></div>
    @include('home.post-add')
    @if($posts->count())
        @foreach($posts as $post)  
            @include('posts._post') 
        @endforeach
    @else 
    <p class="no-posts">NO POST TO SHOW<br>
    <span class="tepo"></span><br>
    <input type="submit" class="fifo55" value="Follow Friend"></p>   
    @endif
</div>
    @include('home.right-sidebar')
    @include('home.profile-hover')
@include('home._partials.logout_box')
@include('template._partials.footer')
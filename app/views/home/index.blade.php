@include('template._partials.header')
    @include('home.nav-top')
    @include('home.left-sidebar')
<div class="poster_memb">
    <div class="error" style="display:none"></div>
    <div class="message" style="display:none"></div>
    @include('home.post-add')
    @foreach($posts as $p)  
        @include('home._partials.post') 
    @endforeach
</div>
    @include('home.right-sidebar')
    @include('home.profile-hover')
@include('home._partials.logout_box')
@include('home._partials.footer')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="{{ asset('js/application.js') }}"></script>
<script type="text/javascript">
    var page = window.location.pathname;
    if(page === '/') {
        Dnianas.Post.getNewPosts();
    }

    // Enable see more
    $('.post-content').readmore({
        speed: 200,
        collapsedHeight: 30,
        moreLink: '<a href="#" class="see-more-link">See more</a>',
        lessLink: '<a href="#" class="see-more-link">See less</a>'
    });
</script>
</body>
</html>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="/js/vendor/readmore.min.js"></script>
<script src="/js/vendor/moment.min.js"></script>
<script src="/js/vendor/livestamp.min.js"></script>
<script src='/js/vendor/jquery.autosize.js'></script>
<script src='/js/dnianas.js'></script>
<script src="/js/init2.js"></script>
<script type="text/javascript">
    var page = window.location.pathname;
    if(page === '/') {
        Dnianas.Post.getNewPosts();
    }

    // Enable see more
    $('.post-content').readmore({
        speed: 200,
        moreLink: '<a href="#" class="see-more-link">See more</a>',
        lessLink: '<a href="#" class="see-more-link">See less</a>'
    });
</script>
</body>
</html>

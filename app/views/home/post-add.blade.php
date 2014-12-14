{{ Form::open(array('url' => 'post/create', 'id' => 'postForm')) }}
        <div class="users_adds">
            <textarea cols="60"  name="post_content" class="normal" placeholder="What's happening?"></textarea>
        </div>
        <div class="links_users_homes">
            <a href class="ri_st11"><span>Update Status</span></a>
            <a href class="ri_st11"><span>Add Photos/Video</span></a>
            <a href class=""><span>Add Books</span></a>
            <input type="submit" class="share-post" value="Share">
        </div>
{{ Form::close() }}
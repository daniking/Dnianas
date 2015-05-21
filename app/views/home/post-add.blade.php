{{ Form::open(array('url' => '/posts/create', 'id' => 'postForm')) }}
        <div class="users_adds">
         <div class="tab_selecrpost">
        <a href class="up52_12"><span>Update Status</span></a>
        <a href class="up52_12 _pic"><span>Add Photo / Video</span></a>
            <input type="submit" class="share-post" value="Post">
        </div>
            <textarea cols="60"  name="post_content" class="normal" placeholder="What's happening?"></textarea>
            <img src="/img/ajax_loader.gif" id="ajax-loader" style="display:none">

        </div>
       
{{ Form::close() }}
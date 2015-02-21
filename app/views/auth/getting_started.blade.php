    <div class="blur"><img src="img/bod.jpg" width="500" height="1000" ></div>
    
    @include('template._partials.error')
    @include('template._partials.message')
    <div id="maincontainer_2">
        <div id="head_up">
            <a href="" class="logo_up">

            </a>
            <a href="{{ route('logout')}}" class="logouts">Logout</a>
        </div>
        <h1 class="welcome_update">Welcome</h1>
        <br>
        {{ Form::open(['url' => 'getting_started']) }}
            <label for="address">Address </label> <br>
            <input type="text" name="address" id="address" placeholder="Address">
            <br> <br>
            <label for="job">Job Title</label> <br>
            <input type="text" name="job_title" id="job" placeholder="Job">
            <br> <br>
            <label for="website">Website </label> <br>
            <input type="text" name="website" id="website" placeholder="Http://example.com">
            <br> <br>
            <label for="about">Write about yourself in 140 characters </label>
            <br>
            <textarea name="about" rows="4" class='normal' maxlength="140"  id="about" placeholder="About You"></textarea> <br /> <br />
            <input type="submit" value="Get started!">

            <small><a href="{{ URL::to('/') }}">Skip</a></small>
        {{ Form::close() }}
        <div class="update_imgs">
           <div class="tab_up_img">
               <img src="img/big_avatar.jpg">
           </div>
        <input type="submit" name="add" value="Save Change" class="_addsphoto">
       </div>
   </div>
@include('template._partials.footer')
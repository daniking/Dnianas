<head>
    <link rel="stylesheet" href="style/update.css">
</head>
<div id="maincontepublic">
    <div class="toptextone">
        <span id="sone">Step One</span>
        <span class="nfoone">Now, Let's Setup Your information</span>
    </div>
    <h1 class="tiitleupd">Set Your information</h1>
    @include('template._partials.error')
    {{ Form::open(['url' => 'getting_started']) }}            
    <label class="text_text_info">
        <input type="text" name="address" class="text_box_info" placeholder="Address"></label>
        <hr class="ssd323">
        <label class="text_text_info">
            <input type="text" name="job_title" class="text_box_info" placeholder="Work at">
        </label>
        <hr class="ssd323">
        <label class="text_text_info">
            <input type="text" name="website" class="text_box_info" placeholder="Website"></label>
            <hr class="ssd323">
            <label class="httext">About You
                <hr class="srxcs">
                <textarea class="_140words" name="about"></textarea><br>

                <span id="tips">Write about yourself in 140 characters 

                </label>

                <hr class="underline">
                <input type="submit" value="Save & Continue" name="" class="sa_co">
                <a href class="skipss">Skip This Step</a>
                <br><br>
                {{ Form::close() }}
        </div>
</div>
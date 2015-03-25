<div class="leftabot" id="memb_sos">
    <h1>About</h1>
    @if($user->about && $user->about->count()) 
        <h2>Live in <span>{{ $user->about->address }}</span></h2>
        <h2>Job Title<span>{{ $user->about->job_title }}</span></h2>
        <h2>Website <span>{{ $user->about->website }}</span></h2>

        <p class="text-about">About</p>
        <p class="about-you" dir="ltr">{{ $user->about->about }}</p>
</div>
    @else
        <p class="about-you" dir="ltr"></p>
@endif
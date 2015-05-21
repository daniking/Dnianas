<div class="leftabot" id="memb_sos">
    <h3 class="taptopus">About</h3>
    @if($user->about && $user->about->count()) 
<div class="abo_us12"><h1>Studied at <span class="auo_12">Cihan</span></h1></div>
<div class="abo_us12"><h1>Address<span class="auo_12">{{ $user->about->address }}</span></h1></div>
<div class="abo_us12"><h1>Birthday<span class="auo_12"></span></h1></div>
<div class="abo_us12"><h1>Lives in<span class="auo_12">{{ $user->about->address }}</span></h1></div>
<div class="abo_us12"><h1>Website<span class="auo_12">{{ $user->about->website }}</span></h1></div>
        
<div class="ph_o_u11">
<h3 class="taptopus">Photos</h3>
<div class="ph_ofuser">
<img src="{{ profile_picture($user) }}" class="taguserph">
<img src="{{ profile_picture($user) }}" class="taguserph">
<img src="{{ profile_picture($user) }}" class="taguserph">

</div>
</div>
<h3 class="taptopus">Followers</h3>
<div class="usefollo">


</div>
<h3 class="taptopus">About Yourself</h3>
        <div class="about-you" dir="ltr">{{ $user->about->about }}</div>

</div>

    @else
@endif
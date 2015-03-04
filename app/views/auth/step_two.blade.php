<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style/update.css">
    <title>Welcome to dnianas / Step one Complete your registeration!</title>
</head>

<body>
    <div id="maincontepublic">
        <div class="toptextone">
            <span id="sone">Step Two</span>
            <span class="nfoone">Now, Let's Setup Your Profile</span>
        </div>
        <h2 class="profilepicset">Set your profile picture</h2>     
        <div class="tabprofilepic">
            <div id="bottlefbox">
                <div class="fileUpload btn btn-primary">
                    <span class="stotext">Upload a photo</span>
                    <br>
                    <span class="tisppic">From your computer</span>
                    <input type="file" accept="image/*" id="profilePicture" class="upload" name="profile_picture" />
                </div>
            </div>
            <div id="pictrigbox"  class="profilePictureBorder"></div>
        </div>

        <div class="tabcoverpic">
            <h2 class="profilepicset _piccov">Set your cover photo</h2>
            <div id="bottlefbox">
                <div class="fileUpload btn btn-primary">
                    <span class="stotext">Upload a photo</span>
                    <br>
                    <span class="tisppic">From your computer</span>
                    <input type="file" accept="image/*" id="coverPhoto" class="upload" name="cover_photo"/>
                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                </div>
            </div>
            <div id="pictrigbox"></div>

        </div>
        <hr class="underline">
        <a href class="skipss">Skip This Step</a>
        <br><br>
    </div>
</div>
<div  id="fo404_234">
    <span>Dnianas Corporation ©2015</span>
    <span>|</span>
    <a href="">About</a>
    <span>-</span>
    <a href="">Help</a>
    <span>-</span>
    <a href="">Terms</a>
    <span>-</span>
    <a href="">Cookies</a>
    <span>-</span>
    <a href="">Privacy</a>
    <span>-</span>
    <a href="">advertising</a>
</div>

{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/imageUpload.js') }}
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload file</title>
</head>
<body>
    <form action="/test/upload" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="file" name="profile_picture">
        <input type="submit" name="upload">
    </form>
    
    <img src="photo/akar.jpg" alt="Your profile picture" style="width: 50px; height: 50px;">
    @if(Session::has('message'))
        {{ Session::get('message') }}
    @endif
</body>
</html>
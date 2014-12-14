<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello! Activate your account</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <style>
        .header {
            font-family: 'Open Sans', sans-serif;
            color: #333;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Hello, {{ $username }}.</h1>
    <h2 class="header">Welcome to Dnianas</h2>
    <h3>Activate your account now to get started, Click this link below:</h3>
    http://laravel.dev/activate/{{ $code }}
</body>
</html>
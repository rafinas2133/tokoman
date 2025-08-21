<?php
$admin = ''.($admin ?? 'Urself');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Goodbye From Tokoman</title>
</head>

<body>
    <img src="{{config('app.aws_url')}}/img/logo.png" width="150" height="150" alt="Logo">
    <h1>Hello, {{ $user->name }}</h1>
    <p>Welcome to TOKOMAN App</p>
    <p>May You Got Best Experience with Us</p>
    <p>If you have any trouble, please contact us at <a
            href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
    </p>
</body>

</html>
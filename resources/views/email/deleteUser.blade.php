<?php
$admin = ''.($admin ?? 'Urself');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Goodbye From Tokoman</title>
</head>

<body>
    <img src="{{config('app.aws_url')}}/img/logo.png" width="300" height="300" alt="Logo">
    <h1>Hello, {{ $user->name }}</h1>
    <p>Goodbye from TOKOMAN App</p>
    <p>Ur Account has been deleted by {{ $admin }}</p>
    <p>If you have any trouble, please contact us at <a
            href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
    </p>
</body>

</html>
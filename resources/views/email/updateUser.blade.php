@php
$admin = ''.($admin ?? 'Urself');
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>User Updated</title>
</head>

<body>
    <img src="{{config('app.aws_url')}}/img/logo.png" width="150" height="150" alt="Logo">
    <h1>Hello, {{ $user->name }}</h1>
    <p>Here is A Recent Action in Your Account</p>
    <p>Ur Account has been edited by {{ $admin }}</p>
    <p>This is your update details</p>
    <ul>
        <li>Name: {{$admin=='admin'? ' Ask Admin':$user->name }}</li>
        <li>Email: {{$admin=='admin'? ' Ask Admin':$user->email }}</li>
        <li>password: {{ $change ? ' Changed' : ' Not Changed' }}</li>
    </ul>
    <p>If you have any trouble, please contact us at <a
            href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
    </p>
</body>

</html>
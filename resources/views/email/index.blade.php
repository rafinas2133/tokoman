<!DOCTYPE html>
<html>

<head>
    <title>Login Notification</title>
</head>

<body>
    <img src="{{config('app.aws_url')}}/img/logo.png" width="150" height="150" alt="Logo">
    <h1>Hello, {{ $username }}</h1>
    <p>You have successfully logged in to TOKOMAN app. Here is your session data:</p>
    <ul>
        <li>IP Address: {{ $sessionData->ip_address }}</li>
        <li>User Agent: {{ $sessionData->user_agent }}</li>
        <li>Last Activity: {{ date('Y-m-d H:i:s', $sessionData->last_activity) }}</li>
        <p>If you don't recognize this activity, please contact us at <a
                href="mailto:{{ config('mail.from.address') }}?subject=Suspicious Access&body=Hi Admin, Iam {{$username}} i had an suspicious access on my accouunt, can you assist an action">{{ config('mail.from.address') }}</a>
        </p>
    </ul>
</body>

</html>
<!DOCTYPE html>
<html>
<head>
    <title>Login Notification</title>
</head>
<body>
    <h1>Hello, {{ $username }}</h1>
    <p>You have successfully logged in. Here is your session data:</p>
    <ul>
        <li>Session ID: {{ $sessionData->id }}</li>
        <li>IP Address: {{ $sessionData->ip_address }}</li>
        <li>User Agent: {{ $sessionData->user_agent }}</li>
        <li>Last Activity: {{ date('Y-m-d H:i:s', $sessionData->last_activity) }}</li>
        <p>If you don't recognize this activity, please contact us at <a href="mailto:tokomananekabotolplastik@gmail.com??subject=Suspicious Access&body=Hi Admin, Iam {{$username}} i had an suspicious access on my accouunt, can you assist an action">tokomananekabotolplastik@gmail.com</a>
        </p>
    </ul>
</body>
</html>
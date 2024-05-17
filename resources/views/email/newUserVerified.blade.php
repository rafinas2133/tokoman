<!DOCTYPE html>
<html>

<head>
    <title>New User Verified</title>
</head>

<body>
    <img src="https://tokoman.s3.ap-southeast-2.amazonaws.com/asset/logo.png" width="300" height="300" alt="Logo">
    <h1>Hello, {{ $users->name }}</h1>
    <p>There is a new user joined to Tokoman</p>
    <p>User Email: {{ $user->email }}</p>
    <p>User Name: {{ $user->name }}</p>
    <p>User Role: {{ $user->role_id==0 ? 'Admin' : 'Employee' }}</p>
    <p>User Verified at: {{ $user->email_verified_at }}</p>
    <p>give the best experience to the user :D</p>
</body>

</html>
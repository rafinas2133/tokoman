<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify User</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            background-color: #edf2f7;
            color: #718096;
            line-height: 1.5;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 32px;
            border-radius: 8px;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
        }

        .content p {
            margin-top: 0;
            margin-bottom: 16px;
        }

        .button-container {
            text-align: center;
            margin: 24px 0;
        }

        .button {
            display: inline-block;
            background-color: #2d3748;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="{{ url('/') }}" style="display: inline-block;">
                <img src="{{config('app.aws_url')}}/img/logo.png" width="150" height="150" alt="Logo">
                <h1 style="color: #2d3748; text-decoration: none;">Tokoman App</h1>
            </a>
        </div>

        <div class="content">
            <p>Hello {{$user->name}},</p>
            <p>Welcome to Tokoman App</p>
            <p>You have been verified to Tokoman App</p>

            <p>If you have any questions, feel free to reach out to us at <a
                    href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tokoman App. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
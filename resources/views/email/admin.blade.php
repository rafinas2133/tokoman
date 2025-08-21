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
            <p>Hello Admin,</p>
            <p>There is new user, <strong>{{ $user->name }}</strong>, who wants to join Tokoman App with the following details:</p>

            <table style="width: 100%; margin: 20px 0; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px; border: 1px solid #e2e8f0; font-weight: bold; width: 30%;">Name</td>
                    <td style="padding: 8px; border: 1px solid #e2e8f0;">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #e2e8f0; font-weight: bold;">Email</td>
                    <td style="padding: 8px; border: 1px solid #e2e8f0;">{{ $user->email }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #e2e8f0; font-weight: bold;">Registration Date</td>
                    <td style="padding: 8px; border: 1px solid #e2e8f0;">{{ $user->created_at->format('d F Y, H:i') }}
                        WIB</td>
                </tr>
            </table>
            <p>Please click the button below to verify and activate this user account.</p>

            <div class="button-container">
                <a href="{{ $verificationUrl }}" class="button">
                    Verify User
                </a>
            </div>

            <p>If you do not wish to accept this user, no further action is required.</p>
            <p>Thank you,<br>Tokoman App Team</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tokoman App. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
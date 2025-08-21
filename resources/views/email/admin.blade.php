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
            <p>Ada pengguna baru, <strong>{{ $user->name }}</strong>, yang ingin bergabung dengan Tokoman App dengan
                detail sebagai berikut:</p>

            <table style="width: 100%; margin: 20px 0; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px; border: 1px solid #e2e8f0; font-weight: bold; width: 30%;">Nama</td>
                    <td style="padding: 8px; border: 1px solid #e2e8f0;">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #e2e8f0; font-weight: bold;">Email</td>
                    <td style="padding: 8px; border: 1px solid #e2e8f0;">{{ $user->email }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #e2e8f0; font-weight: bold;">Tanggal Daftar</td>
                    <td style="padding: 8px; border: 1px solid #e2e8f0;">{{ $user->created_at->format('d F Y, H:i') }}
                        WIB</td>
                </tr>
            </table>
            <p>Silakan klik tombol di bawah untuk memverifikasi dan mengaktifkan akun pengguna ini.</p>

            <div class="button-container">
                <a href="{{ $verificationUrl }}" class="button">
                    Verify User
                </a>
            </div>

            <p>Jika Anda tidak ingin menerima pengguna ini, tidak perlu ada tindakan lebih lanjut.</p>
            <p>Terima kasih,<br>Tim Tokoman App</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tokoman App. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html>
<head>
    <title>Password Email</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f6f8fa;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 420px;
            margin: 40px auto;
            padding: 32px 24px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        h1 {
            color: #2c3e50;
            font-size: 1.6em;
            margin-bottom: 16px;
        }
        p {
            color: #444;
            font-size: 1.1em;
            margin-bottom: 20px;
        }
        .info-box {
            background: #f0f4f8;
            color: #333;
            font-size: 1em;
            padding: 8px 14px;
            border-radius: 5px;
            margin-bottom: 18px;
            word-break: break-all;
        }
        .password-box {
            display: inline-block;
            background: #eaf4ff;
            color: #1565c0;
            font-weight: bold;
            font-size: 1.2em;
            padding: 8px 18px;
            border-radius: 5px;
            letter-spacing: 1px;
            margin-top: 8px;
        }
        .note {
            color: #888;
            font-size: 0.97em;
            margin-top: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bonjour&nbsp;!</h1>
        <p>Voici vos identifiants pour vous connecter&nbsp;:</p>
        <div class="info-box"><strong>Email&nbsp;:</strong> {{ $email }}</div>
        <div class="password-box">{{ $password }}</div>
        <p>
            Utilisez cet email et ce mot de passe pour vous connecter à votre compte.
        </p>
        <p class="note">
            Veuillez modifier votre mot de passe dès que possible pour garantir la sécurité de votre compte.
        </p>
    </div>
</body>
</html>

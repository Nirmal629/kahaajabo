<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Login OTP</title>
</head>

<body style="margin:0; padding:0; background:#f5f5f5;">

    <div style="
        max-width:600px;
        margin:40px auto;
        background:#ffffff;
        padding:30px;
        font-family:Arial, sans-serif;
        border-radius:8px;
    ">

        <h2 style="margin-top:0;">
            Login Verification
        </h2>

        <p>
            Hello {{ $userName }},
        </p>

        <p>
            We received a request to sign in to your account.
        </p>

        <p>
            Your One-Time Password (OTP) is:
        </p>

        <div style="
            text-align:center;
            margin:25px 0;
        ">

            <span style="
                display:inline-block;
                background:#f1f1f1;
                padding:15px 30px;
                font-size:28px;
                font-weight:bold;
                letter-spacing:8px;
                border-radius:6px;
            ">
                {{ $otp }}
            </span>

        </div>

        <p>
            This OTP is valid for <strong>10 minutes</strong>.
        </p>

        <p>
            If you did not request this login, you can safely ignore
            this email.
        </p>

        <p>
            Thank you.
        </p>

    </div>

</body>
</html>
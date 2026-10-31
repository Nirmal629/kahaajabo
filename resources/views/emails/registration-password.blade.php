<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">

    <title>Registration Successful</title>

</head>

<body style="
    margin:0;
    padding:0;
    background:#f5f5f5;
    font-family:Arial, Helvetica, sans-serif;
">

<table width="100%"
       cellpadding="0"
       cellspacing="0"
       style="padding:40px 0;">

    <tr>

        <td align="center">

            <table width="600"
                   cellpadding="0"
                   cellspacing="0"
                   style="
                        background:#ffffff;
                        border-radius:8px;
                        padding:40px;
                   ">

                <!-- Heading -->

                <tr>

                    <td align="center">

                        <div style="
                            width:60px;
                            height:60px;
                            line-height:60px;
                            border-radius:50%;
                            background:#28a745;
                            color:#ffffff;
                            font-size:32px;
                            font-weight:bold;
                            margin-bottom:20px;
                        ">
                            ✓
                        </div>

                        <h2 style="
                            margin:0 0 20px;
                            color:#222;
                        ">
                            Registration Successful!
                        </h2>

                    </td>

                </tr>


                <!-- Message -->

                <tr>

                    <td>

                        <p style="
                            font-size:16px;
                            color:#555;
                            line-height:1.6;
                        ">

                            Hello
                            <strong>
                                {{ $user->first_name }}
                            </strong>,

                        </p>

                        <p style="
                            font-size:16px;
                            color:#555;
                            line-height:1.6;
                        ">

                            Your registration has been
                            successfully completed.

                        </p>

                        <p style="
                            font-size:16px;
                            color:#555;
                            line-height:1.6;
                        ">

                            You can now login using the
                            credentials below.

                        </p>

                    </td>

                </tr>


                <!-- Login Details -->

                <tr>

                    <td style="
                        padding:20px;
                        background:#f8f8f8;
                        border-radius:6px;
                    ">

                        <p style="
                            margin:0 0 10px;
                            font-size:15px;
                            color:#555;
                        ">

                            <strong>Email:</strong>

                            {{ $user->email }}

                        </p>

                        <p style="
                            margin:0;
                            font-size:15px;
                            color:#555;
                        ">

                            <strong>Password:</strong>

                            <span style="
                                color:#625be7;
                                font-weight:bold;
                            ">

                                {{ $password }}

                            </span>

                        </p>

                    </td>

                </tr>


                <!-- Login Button -->

                <tr>

                    <td align="center"
                        style="padding:30px 0;">

                        <a href="{{ route('home.index') }}?open_login=1"
                           style="
                                display:inline-block;
                                padding:13px 30px;
                                background:#625be7;
                                color:#ffffff;
                                text-decoration:none;
                                border-radius:5px;
                                font-size:16px;
                           ">

                            Login Now

                        </a>

                    </td>

                </tr>


                <!-- Security Message -->

                <tr>

                    <td>

                        <p style="
                            font-size:14px;
                            color:#777;
                            line-height:1.6;
                        ">

                            For security reasons, please change
                            your password after logging in.

                        </p>

                        <p style="
                            font-size:14px;
                            color:#777;
                            line-height:1.6;
                        ">

                            If you did not create this account,
                            please contact our support team.

                        </p>

                    </td>

                </tr>


                <!-- Footer -->

                <tr>

                    <td style="
                        padding-top:30px;
                        border-top:1px solid #eeeeee;
                    ">

                        <p style="
                            margin:0;
                            font-size:13px;
                            color:#999;
                            text-align:center;
                        ">

                            This is an automated email.
                            Please do not reply.

                        </p>

                    </td>

                </tr>

            </table>

        </td>

    </tr>

</table>

</body>
</html>
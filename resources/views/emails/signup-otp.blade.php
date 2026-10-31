<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">

    <title>OTP Verification</title>

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

                <tr>

                    <td align="center">

                        <h2 style="
                            margin:0 0 20px;
                            color:#222;
                        ">
                            OTP Verification
                        </h2>

                    </td>

                </tr>

                <tr>

                    <td>

                        <p style="
                            font-size:16px;
                            color:#555;
                            line-height:1.6;
                        ">
                            Hello,
                        </p>

                        <p style="
                            font-size:16px;
                            color:#555;
                            line-height:1.6;
                        ">
                            Thank you for registering with us.
                            Please use the OTP below to complete
                            your registration.
                        </p>

                    </td>

                </tr>

                <tr>

                    <td align="center"
                        style="padding:20px 0;">

                        <div style="
                            display:inline-block;
                            padding:15px 30px;
                            background:#f0efff;
                            border-radius:6px;
                            font-size:32px;
                            font-weight:bold;
                            letter-spacing:8px;
                            color:#625be7;
                        ">

                            {{ $otp }}

                        </div>

                    </td>

                </tr>

                <tr>

                    <td>

                        <p style="
                            font-size:14px;
                            color:#777;
                            line-height:1.6;
                        ">
                            This OTP is valid for
                            <strong>5 minutes</strong>.
                        </p>

                        <p style="
                            font-size:14px;
                            color:#777;
                            line-height:1.6;
                        ">
                            Please do not share this OTP with anyone.
                        </p>

                    </td>

                </tr>

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
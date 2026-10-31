<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Email Verification OTP</title>
</head>

<body style="
    margin:0;
    padding:0;
    background:#f5f6f8;
    font-family:Arial, Helvetica, sans-serif;
">

    <table width="100%"
           cellpadding="0"
           cellspacing="0"
           border="0"
           style="background:#f5f6f8; padding:40px 15px;">

        <tr>

            <td align="center">

                <table width="600"
                       cellpadding="0"
                       cellspacing="0"
                       border="0"
                       style="
                           max-width:600px;
                           width:100%;
                           background:#ffffff;
                           border-radius:10px;
                           overflow:hidden;
                       ">

                    {{-- Header --}}
                    <tr>

                        <td style="
                            padding:25px 30px;
                            text-align:center;
                            background:#ffffff;
                            border-bottom:1px solid #eeeeee;
                        ">

                            <h2 style="
                                margin:0;
                                font-size:24px;
                                color:#222222;
                            ">
                                Email Verification
                            </h2>

                        </td>

                    </tr>


                    {{-- Body --}}
                    <tr>

                        <td style="
                            padding:35px 30px;
                            color:#444444;
                        ">

                            <p style="
                                margin:0 0 15px;
                                font-size:16px;
                                line-height:1.6;
                            ">
                                Hello
                                <strong>{{ $userName }}</strong>,
                            </p>


                            <p style="
                                margin:0 0 20px;
                                font-size:15px;
                                line-height:1.6;
                            ">
                                Thank you for registering with us.
                                Please use the following OTP to
                                verify your email address and
                                complete your registration.
                            </p>


                            {{-- OTP --}}
                            <div style="
                                text-align:center;
                                margin:30px 0;
                            ">

                                <div style="
                                    display:inline-block;
                                    padding:15px 30px;
                                    background:#f4f4f4;
                                    border-radius:8px;
                                    border:1px solid #dddddd;
                                ">

                                    <span style="
                                        font-size:30px;
                                        font-weight:bold;
                                        letter-spacing:8px;
                                        color:#222222;
                                    ">
                                        {{ $otp }}
                                    </span>

                                </div>

                            </div>


                            <p style="
                                margin:0 0 10px;
                                font-size:14px;
                                line-height:1.6;
                                text-align:center;
                                color:#666666;
                            ">
                                This OTP is valid for
                                <strong>10 minutes</strong>.
                            </p>


                            <p style="
                                margin:25px 0 0;
                                font-size:14px;
                                line-height:1.6;
                                color:#666666;
                            ">
                                If you did not request this
                                registration, you can safely
                                ignore this email.
                            </p>

                        </td>

                    </tr>


                    {{-- Footer --}}
                    <tr>

                        <td style="
                            padding:20px 30px;
                            background:#f8f8f8;
                            text-align:center;
                            border-top:1px solid #eeeeee;
                        ">

                            <p style="
                                margin:0;
                                font-size:12px;
                                color:#888888;
                            ">
                                This is an automated email.
                                Please do not reply to this email.
                            </p>

                            <p style="
                                margin:8px 0 0;
                                font-size:12px;
                                color:#888888;
                            ">
                                &copy; {{ date('Y') }}
                                All rights reserved.
                            </p>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>
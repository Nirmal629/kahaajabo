<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - KahaanJabo</title>
</head>

<body style="margin:0; padding:0; background-color:#f1f5f9; font-family:Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
        style="background-color:#f1f5f9; padding:30px 10px;">

        <tr>
            <td align="center">

                <!-- MAIN CONTAINER -->
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="width:100%; max-width:600px; background-color:#ffffff; border-radius:10px; overflow:hidden;">

                    <!-- LOGO -->
                    <tr>
                        <td align="left" style="background-color:#FCBF1F; padding:7px; margin:0; line-height:0;">

                            <a href="{{ url('/') }}" style="display:block; text-decoration:none;">

                                <img src="https://casainfotech.com/KaahaJabo/public/Frontend/Assets/images/logo1.png"
                                    width="600" alt="KahaanJabo"
                                    style="display:block;
                        width:200px;
                        max-width:100%;
                        height:auto;
                        border:0;
                        outline:none;">

                            </a>

                        </td>
                    </tr>

                    <!-- SUCCESS HEADER -->
                    <tr>
                        <td align="center" style="background-color:#2563eb; padding:35px 20px;">

                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" valign="middle"
                                        style="width:55px; height:55px; background-color:#ffffff; border-radius:50%; color:#16a34a; font-size:32px; font-weight:bold;">
                                        &#10003;
                                    </td>
                                </tr>
                            </table>

                            <h1 style="margin:16px 0 0; color:#ffffff; font-size:25px; line-height:32px;">
                                Registration Successful!
                            </h1>

                            <p style="margin:10px 0 0; color:#dbeafe; font-size:14px;">
                                Welcome aboard!
                            </p>

                        </td>
                    </tr>

                    <!-- EMAIL CONTENT -->
                    <tr>
                        <td style="padding:32px 30px; color:#64748b; font-size:14px; line-height:1.7;">

                            <h2 style="margin:0 0 12px; color:#1f2937; font-size:21px;">
                                Hello, {{ $user->first_name }}!
                            </h2>

                            <p style="margin:0 0 14px;">
                                Congratulations! Your registration has been completed successfully.
                                We're delighted to welcome you to the KahaanJabo family.
                            </p>

                            <p style="margin:0 0 22px;">
                                Your account is now active. You can use the login details below
                                to access your account and explore our services.
                            </p>

                            <!-- ACCOUNT DETAILS -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="border:1px solid #e2e8f0; border-radius:8px;">

                                <tr>
                                    <td colspan="2"
                                        style="padding:14px 18px; background-color:#eff6ff; border-bottom:1px solid #dbeafe;">

                                        <h3 style="margin:0; color:#1e40af; font-size:16px;">
                                            Your Account Information
                                        </h3>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 18px 5px; color:#64748b; font-size:12px;">
                                        FULL NAME
                                    </td>
                                    <td style="padding:12px 18px 5px; color:#334155; font-size:13px; font-weight:bold;">
                                        {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:8px 18px 5px; color:#64748b; font-size:12px;">
                                        EMAIL ADDRESS
                                    </td>
                                    <td
                                        style="padding:8px 18px 5px; color:#334155; font-size:13px; font-weight:bold; word-break:break-word;">
                                        {{ $user->email }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:8px 18px 5px; color:#64748b; font-size:12px;">
                                        PASSWORD
                                    </td>
                                    <td style="padding:8px 18px 5px; color:#334155; font-size:13px; font-weight:bold;">
                                        {{ $password }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:8px 18px 5px; color:#64748b; font-size:12px;">
                                        REGISTRATION DATE
                                    </td>
                                    <td style="padding:8px 18px 5px; color:#334155; font-size:13px;">
                                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : now()->format('d/m/Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:8px 18px 15px; color:#64748b; font-size:12px;">
                                        ACCOUNT STATUS
                                    </td>
                                    <td style="padding:8px 18px 15px; color:#16a34a; font-size:13px; font-weight:bold;">
                                        Active
                                    </td>
                                </tr>

                            </table>

                            <!-- SECURITY NOTICE -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="margin-top:18px; background-color:#eff6ff; border-radius:6px;">

                                <tr>
                                    <td style="padding:12px 15px; color:#475569; font-size:12px; line-height:1.6;">
                                        <strong style="color:#1e40af;">Security Reminder</strong><br>
                                        Please keep your login credentials confidential.
                                        Never share your password with anyone.
                                    </td>
                                </tr>

                            </table>

                            <!-- LOGIN BUTTON -->
                            {{-- <table width="100%" cellpadding="0" cellspacing="0" border="0"
                style="margin:28px 0;">

                <tr>
                    <td align="center">

                        <a href="{{ url('/login') }}"
                            style="display:inline-block; padding:13px 30px; background-color:#2563eb; color:#ffffff; text-decoration:none; font-size:14px; font-weight:bold; border-radius:6px;">

                            Log In to Your Account

                        </a>

                    </td>
                </tr>

            </table> --}}

                            {{-- <p style="margin:0 0 14px;">
                Thank you for choosing KahaanJabo. We look forward to
                making your journeys easier and more memorable.
            </p>

            <p style="margin:0; color:#334155;">
                Best regards,<br>
                <strong>Team KahaanJabo</strong>
            </p> --}}

                        </td>
                    </tr>

                    <!-- FOOTER -->

                    <!-- FOOTER -->
                    <tr>
                        <td align="center"
                            style="background-color:#011E49;
                padding:28px 20px;
                border-top:3px solid #2563eb;">

                            <!-- CONTACT SUPPORT -->
                            <p
                                style="margin:0 0 12px;
                    color:#ffffff;
                    font-size:13px;
                    line-height:20px;">

                                Need help?
                                <a href="{{ url('/contact') }}"
                                    style="color:#ffffff;
                        font-weight:bold;
                        text-decoration:underline;">
                                    Contact Support
                                </a>

                            </p>

                            <!-- COPYRIGHT -->
                            <p
                                style="margin:0 0 10px;
                    color:#ffffff;
                    font-size:12px;
                    line-height:18px;">

                                &copy; {{ date('Y') }} Kahaanjabo.com.
                                All rights reserved.

                            </p>

                            <!-- AUTOMATED EMAIL MESSAGE -->
                            <p
                                style="margin:0;
                    color:#cbd5e1;
                    font-size:11px;
                    line-height:18px;">

                                This is an automated email. Please do not reply.

                            </p>

                        </td>
                    </tr>


                </table>

            </td>
        </tr>

    </table>

</body>

</html>

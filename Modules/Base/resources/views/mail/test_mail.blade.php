<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Email</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f5f5f5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 6px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                    <tr>
                        <td style="background-color: #4CAF50; padding: 20px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0;">Test Email</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px; color: #333333; line-height: 1.6;">
                                Hello,
                            </p>
                            <p style="font-size: 16px; color: #333333; line-height: 1.6;">
                                {{$body}}
                            </p>
                            <p style="font-size: 16px; color: #333333; line-height: 1.6;">
                                Regards,<br>
                                {{ $siteData['site_name'] }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f0f0f0; padding: 20px; text-align: center; font-size: 12px; color: #888888;">
                            &copy; {{ date('Y') }} {{ $siteData['site_name'] }}. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

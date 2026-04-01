<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EPD2026 Registration</title>
</head>

<body style="margin:0; padding:0; background:#f5f5f5; font-family: Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f5f5; padding:20px;">
<tr>
<td align="center">

    <!-- MAIN CONTAINER -->
    <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden;">

        <!-- HEADER -->
        <tr>
            <td style="padding:20px; text-align:center; border-bottom:1px solid #eee;">
                <img src="https://cejzambia.org/wp-content/uploads/2023/01/High-Resolution4-1-768x799.png" height="60" alt="EPD Logo">
                <h2 style="margin:10px 0 0; font-size:18px; color:#333;">EPD2026 Conference</h2>
            </td>
        </tr>

        <!-- BODY -->
        <tr>
            <td style="padding:30px; color:#333;">

                <p style="margin:0 0 15px;">Hello <strong>{{ $participant->name }}</strong>,</p>

                <p style="margin:0 0 15px; line-height:1.6;">
                    Your registration for <strong>EPD2026</strong> has been successfully completed.
                </p>

                <p style="margin:0 0 15px; line-height:1.6;">
                    Your payment has been received, and your official ticket is attached to this email.
                </p>

                <!-- SUMMARY BOX -->
                <div style="background:#f9f9f9; padding:15px; border-radius:6px; margin:20px 0;">
                    <p style="margin:5px 0;"><strong>Package:</strong> {{ $participant->ticketPackage }}</p>
                    <p style="margin:5px 0;"><strong>Amount Paid:</strong> ZMW {{ number_format($participant->amount, 2) }}</p>
                    <p style="margin:5px 0;"><strong>Status:</strong> Paid</p>
                </div>

                <p style="margin:0 0 15px; line-height:1.6;">
                    Please present your ticket (QR code) at the event for verification.
                </p>

                <p style="margin-top:20px;">
                    Thank you for being part of EPD2026.
                </p>

                <p style="margin-top:20px;">
                    Regards,<br>
                    <strong>EPD2026 Team</strong>
                </p>

            </td>
        </tr>

        <!-- FOOTER -->
        <tr>
            <td style="padding:20px; text-align:center; font-size:12px; color:#888; border-top:1px solid #eee;">
                Lusaka, Zambia<br>
                support@epd2026.org | +260 XXX XXX XXX
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-top: none;
        }
        .field {
            margin-bottom: 20px;
        }
        .field-label {
            font-weight: bold;
            color: #f59e0b;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .field-value {
            color: #1f2937;
            font-size: 15px;
            padding: 10px;
            background: white;
            border-left: 3px solid #f59e0b;
            border-radius: 4px;
        }
        .message-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-top: 10px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 12px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-size: 24px;">New Contact Form Submission</h1>
    </div>

    <div class="content">
        <p style="margin-bottom: 25px; color: #6b7280;">You have received a new message from your website contact form:</p>

        <div class="field">
            <div class="field-label">Name</div>
            <div class="field-value">{{ $senderName }}</div>
        </div>

        <div class="field">
            <div class="field-label">Email</div>
            <div class="field-value">
                <a href="mailto:{{ $senderEmail }}" style="color: #f59e0b; text-decoration: none;">{{ $senderEmail }}</a>
            </div>
        </div>

        <div class="field">
            <div class="field-label">Phone</div>
            <div class="field-value">{{ $senderPhone }}</div>
        </div>

        <div class="field">
            <div class="field-label">Message</div>
            <div class="message-box">{{ $messageContent }}</div>
        </div>
    </div>

    <div class="footer">
        <p style="margin: 0;">This email was sent from your website contact form.</p>
        <p style="margin: 5px 0 0 0;">{{ date('F d, Y - h:i A') }}</p>
    </div>
</body>
</html>

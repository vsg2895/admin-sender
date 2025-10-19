<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Email Template</title>
    <style type="text/css">
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        table {
            border-collapse: collapse;
        }
        .email-container {
            margin: 0 auto;
            background-color: #ffffff;
        }
        td {
            font-size: 14px;
            color: #333333;
            line-height: 1.4;
        }
        .email-image {
            max-width: 100%;
            height: auto;
            display: block;
        }
        @media (prefers-color-scheme: dark) {
            body, .email-container {
                background-color: #1a1a1a !important;
                color: #ffffff !important;
            }
            .email-image {
                filter: brightness(0.9);
            }
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }
        }
    </style>
    <!--[if mso]>
    <style type="text/css">
        body, table, td {
            font-family: Arial, sans-serif !important;
        }
    </style>
    <![endif]-->
</head>
<body>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="email-container">
    <tr>
        <td style="padding: 0; margin: 0;">
            <img src="{{ asset('storage/images/' . $data->image) }}" alt="Email Image" class="email-image" style="max-width: 100%; height: auto; display: block;">
            {!! $data->content !!}
        </td>
    </tr>
</table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .otp {
            font-size: 36px;
            color: #4285f4;
            font-weight: bold;
            letter-spacing: 6px;
        }

        p {
            color: #666;
            margin-top: 20px;
        }

        @media screen and (max-width: 600px) {
            .container {
                padding: 0;
                margin: 0;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <img class="logo" src="https://crm.junglesafariindia.in/dist/img/logo.png" alt="GISA Logo" width="150px" height="150px">

        <h1>GISA</h1>

        <p><b>Hii {{ $name }},</b></p>
        <p>Your <b>Issue: {{ $issue }}, Ticket ID: {{ $ticketId }}</b> has been resolved. Thanks for your patience and time, and we hope our customer support was satisfactory.</p>

        <p>If there is anything else we can do for you, please don’t hesitate to reply to this <b>example@gmail.com</b> or call us at <b>8989989898</b>.</p>

        <p><b>Best,<br>
        GISA</b></p>
    </div>
</body>

</html>

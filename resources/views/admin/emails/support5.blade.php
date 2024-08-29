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
        <p>I’m reaching out about your case with us regarding <b>{{ $issue }}</b>. It’s been <b>{{ $days }}</b> days since we’ve heard from you, so I wanted to let you know that we are going to close this ticket.</p>

        <p>You can always reopen it or raise a new ticket if you need any further assistance. Thanks for working with us!</p>

        <p><b>Regards,<br>
        GISA</b></p>
    </div>
</body>

</html>

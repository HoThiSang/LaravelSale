<!-- resources/views/emails/customerEmail.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email to Customer</title>
    <!-- Bootstrap 5.0.2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333333;
            margin-bottom: 20px;
        }

        .message {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .message h2 {
            color: #333333;
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer p {
            color: #666666;
            font-size: 14px;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header text-center">
            <h1>Hi, V_Splush store</h1>
        </div>
        <div class="message">
            <h2>{{ $title }}</h2>
            <h2>{{ $userName }}</h2>
            <p>{{ $content }}</p>
            <p>{{ $password }}</p>
        </div>
        <div class="footer">
            <p>Best Regards,<br>Your Company</p>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Using Wora</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
            font-size: 28px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            margin-top: 30px;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello {{ $user->name }},</h1>

        <p>We wanted to take a moment to sincerely thank you for choosing Wora as your platform of choice! We are thrilled to have you as part of our growing community and we hope that our service has exceeded your expectations so far.</p>

        <p>At Wora, we are dedicated to providing you with an exceptional experience. Our team works tirelessly to ensure that you have the best tools available to help you write and share content effortlessly. Whether you're using it for personal projects or professional tasks, we strive to make the process as seamless and enjoyable as possible.</p>

        <p>We have many exciting updates and features in the pipeline, and we want you to be the first to experience them. Please stay connected with us for new releases, updates, and more.</p>

        <p>If you ever have any questions, feedback, or suggestions, our support team is always here for you. We are committed to continuously improving Wora based on your needs and would love to hear from you.</p>

        <p>Thank you once again for being a part of the Wora family. We look forward to serving you for many years to come!</p>

        <a href="{{ url('/') }}" class="button">Explore More Features</a>

        <div class="footer">
            <p>Best regards,</p>
            <p>The Wora Team</p>
            <p>Need help? <a href="mailto:support@wora.com">Contact Support</a></p>
            <p>Follow us on <a href="#">Facebook</a>, <a href="#">Twitter</a>, and <a href="#">Instagram</a></p>
        </div>
    </div>
</body>
</html>

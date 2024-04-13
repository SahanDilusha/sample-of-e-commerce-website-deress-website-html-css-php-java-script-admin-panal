<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailerFile/src/Exception.php';
require 'PHPMailerFile/src/PHPMailer.php';
require 'PHPMailerFile/src/SMTP.php';

if (!isset($_SESSION["otp"]) || !isset($_COOKIE["email"])) {
    echo ("Error! Please go back to the login page.");
} else {
    $getOtp = $_SESSION["otp"];
    $email  = $_COOKIE['email'];

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sdilusha34@gmail.com';
    $mail->Password = 'pjfsvhvtyxoahcrv';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('sdilusha34@gmail.com');
    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = 'Verify Login';
    $mail->Body = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
        }

        .otp-code {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            color: #666;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Password Reset OTP</h2>
        <p>Please use the following One-Time Password (OTP) to reset your password:</p>
        <p class="otp-code">' . $getOtp . '</p>
        <p>If you did not request a password reset, you can safely ignore this email.</p>
        <div class="footer">
            This email was sent by <strong>Krist</strong>.<br>
            &copy; ' . date("Y") . ' Your Company. All rights reserved.
        </div>
    </div>
</body>

</html>';

    if ($mail->send()) {
        $_SESSION["otp"] = $getOtp;
        echo ("ok");
        exit;
    } else {
        echo 'Error sending email: ' . $mail->ErrorInfo;
    }
}

<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailerFile/src/Exception.php';
require 'PHPMailerFile/src/PHPMailer.php';
require 'PHPMailerFile/src/SMTP.php';

include "connecton.php";
include "generate-otp.php";

if (!isset($_SESSION["otp"]) || !isset($_COOKIE["email"]) || !isset($_SESSION["temp_user"])) {
    header("Location: http://localhost/myshop-admin/index.php");
    exit;
} else {

    $checkUser = Database::search("SELECT `system_login`.`otp` FROM `system_login` WHERE `system_login`.`system_login_username` = '" . $_SESSION["temp_user"]["system_login_username"] . "' AND `system_login`.`password` = '" . $_SESSION["temp_user"]["password"] . "' 
    AND `system_login`.`stetus_stetus_id` = '1';");

    if ($checkUser->num_rows == 0) {
        header("Location: http://localhost/myshop-admin/index.php");
        exit;
    } else {


        $getOtp = $checkUser->fetch_assoc()["otp"];
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
            Database::iud("UPDATE `system_login` SET `system_login`.`otp` = '" . GenerateOtp::generateOTP(6) . "' WHERE `system_login`.`system_login_username` = '" . $_SESSION["temp_user"]["system_login_username"] . "';");
            echo ("ok");
            exit;
        } else {
            echo 'Error sending email: ' . $mail->ErrorInfo;
        }
    }
}

?>
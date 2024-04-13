<?php

session_start();

include "connecton.php";
include "generate-otp.php";

if (!isset($_SESSION["otp"]) || !isset($_COOKIE["email"]) || !isset($_SESSION["temp_user"])) {
    echo ("Error! Please go back to the login page.");
    exit;
} else {

    $userCode = $_POST["code"];

    if ($userCode == "") {
        echo ("Please enter your OTP code");
        exit;
    } else {

        if ($userCode == $_SESSION["otp"]) {

            Database::iud("UPDATE `system_login` SET `system_login`.`otp` = '" . GenerateOtp::generateOTP(6) . "' WHERE `system_login`.`system_login_username` = '" . $_SESSION["temp_user"]["system_login_username"] . "';");

            $_SESSION["user"] = $_SESSION["temp_user"];
            unset($_SESSION["temp_user"]);
            unset($_SESSION["otp"]);

            echo ("ok");

            header("Location: http://localhost/myshop-admin/dashboard.php");
            exit;
        } else {
            echo ("Wrong OTP Code!");
            exit;
        }
    }
}

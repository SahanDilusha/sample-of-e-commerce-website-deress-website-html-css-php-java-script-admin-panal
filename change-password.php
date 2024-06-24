<?php
session_start();
if (isset($_POST["c_passwrod"]) && isset($_POST["new_passwrod"]) && isset($_POST["co_passwrod"]) && isset($_SESSION["user2"])) {

    if (empty($_POST["c_passwrod"])) {
        echo ("Current password is required!");
    } elseif (empty($_POST["new_passwrod"])) {
        echo ("New password is required!");
    } elseif (empty($_POST["new_passwrod"])) {
        echo ("Confirm password is required!");
    } else if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,45}$/', $_POST["c_passwrod"])) {
        echo ("Current password is invalid!");
    } else if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,45}$/', $_POST["new_passwrod"])) {
        echo ("New password is invalid!");
    } else if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,45}$/', $_POST["co_passwrod"])) {
        echo ("Confirm password is invalid!");
    } elseif ($_POST["new_passwrod"] !== $_POST["co_passwrod"]) {
        echo ("Confirm your password!");
    } else if ($_SESSION["user2"]["password"] !== $_POST["c_passwrod"]) {
        echo ("Current password is invalid!");
    } else {
        include "connecton.php";

        Database::iud("UPDATE `system_login` SET `password` = '" . $_POST["co_passwrod"] . "' WHERE `system_login_username` = '" . $_SESSION["user2"]["system_login_username"] . "';");

        session_destroy();
        echo ("ok");
    }
} else {
    echo ("Error!");
}

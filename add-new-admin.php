<?php
if (!isset($_POST["email"])) {
    echo ("Email addres can't be empty");
} elseif (!isset($_POST["fname"])) {
    echo ("First name can't be empty");
} elseif (!isset($_POST["lname"])) {
    echo ("Last name can't be empty.");
} elseif (!isset($_POST["mobile"])) {
    echo ("Mobile number can't be empty.");
} elseif ($_POST["email"] == "") {
    echo ("Email addres can't be empty");
} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo ("This is not a valid email address!" . $_POST["email"]);
} elseif ($_POST["fname"] == "") {
    echo ("First name can't be empty");
} elseif ($_POST["lname"] == "") {
    echo ("Please enter your last name");
} elseif ($_POST["mobile"] == "") {
    echo ("please enter mobile number");
} else if (!preg_match("/^[0]{1}[7]{1}[01245678]{1}[0-9]{7}$/", $_POST["mobile"])) {
    echo ("Invalid mobile number");
} else {
    include "connecton.php";

    $checkData = Database::search("SELECT * FROM `system_login` WHERE `system_login`.`mobile` = '" . $_POST["mobile"] . "' OR `system_login`.`email` = '" . $_POST["email"] . "'");

    if ($checkData->num_rows == 0) {

        include "generate-password.php";
        include "generate-otp.php";

        $username = strstr($_POST["email"], '@', true);

        Database::iud("INSERT INTO `system_login`(
        `system_login_username`,
        `password`,
        `system_login_r_date`,
        `stetus_stetus_id`,
        `types_types_id`,
        `email`,
        `two_step`,
        `otp`,
        `stetus_dp`,
        `mobile`,
        `first_name`,
        `last_name`) VALUES(
        '" . $username . "',
        '" . GeneratePassword::generatePassword(8) . "',
        '" . date('Y-m-d H:i:s') . "',
        '1',
        '4',
        '" . $_POST["email"] . "',
        '1',
        '" . GenerateOtp::generateOTP(6) . "',
        '2',
        '" . $_POST["mobile"] . "',
        '" . $_POST["fname"] . "',
        '" . $_POST["lname"] . "'
        );");

        echo("ok");

    } else {
        $row = $checkData->fetch_assoc();

        if ($row["mobile"] == $_POST["mobile"]) {
            echo ("This phone number has already been registered!");
        } elseif ($row["email"] == $_POST["email"]) {
            echo ("This email has already been registered!");
        }
    }
}

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

        Database::iud("INSERT INTO `system_login`(`system_login_username`,
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
        
        );");
    } else {
        $row = $checkData->fetch_assoc();

        if ($row["mobile"] == $_POST["mobile"]) {
            echo ("This phone number has already been registered!");
        } elseif ($row["email"] == $_POST["email"]) {
            echo ("This email has already been registered!");
        }
    }
}

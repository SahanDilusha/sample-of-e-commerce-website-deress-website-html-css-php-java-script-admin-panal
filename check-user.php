<?php 

include "connecton.php";

$username = $_POST["username"];
$password = $_POST["password"];

if ($username == "") {
    echo ("Please enter your username!");
} else if ($password == "") {
    echo ("Password is required!");
} else if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,45}$/', $password)) {
    echo ("Invalid password!");
} else {

    $checkUser = Database::search("SELECT * FROM `system_login` WHERE `system_login`.`system_login_username` = '" . $username . "' AND `system_login`.`password` = '" . $password . "' 
    AND `system_login`.`stetus_stetus_id` = '1';");

    if ($checkUser->num_rows == 0) {
        echo ("Invalid username or password!");
    } else {
        header("Location: http://localhost/myshop-admin/data-backup.php");
        exit;
    }
}
?>
<?php
if (isset($_POST["st"]) && !empty($_POST["st"])) {
    include "connecton.php";
    session_start();
    Database::iud("UPDATE `system_login` SET `two_step` = '" . $_POST["st"] . "' WHERE `system_login_username` = '" . $_SESSION["user2"]["system_login_username"] . "';");
    session_destroy();
    echo("ok");
} else {
    echo ("Error!");
}

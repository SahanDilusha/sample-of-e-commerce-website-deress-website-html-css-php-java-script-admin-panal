<?php

session_start();

include "connecton.php";

Database::iud("UPDATE `system_login` SET `stetus_stetus_id` = '6' WHERE `system_login_username` = '" . $_SESSION["user2"]["system_login_username"] . "';");
session_destroy();
echo ("ok");

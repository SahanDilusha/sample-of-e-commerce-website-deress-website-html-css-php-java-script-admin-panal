<?php

include "connecton.php";

if (isset($_POST["st"]) || isset($_POST["username"])) {

    if ($_POST["st"] != "" && $_POST["username"] != "") {

        $checkuser = Database::search("SELECT * FROM `system_login` WHERE  `system_login_username` = '".$_POST["username"]."';");

        if ($checkuser->num_rows == 1) {
            

            if ($_POST["st"] != $checkuser->fetch_assoc()["stetus_stetus_id"]) {

                Database::iud("UPDATE `system_login` SET `system_login`.`stetus_stetus_id` = '" . $_POST["st"] . "' WHERE `system_login_username` = '".$_POST["username"]."';");
                echo ('status changed');
            }
        } else {
            echo ("Error: Invoice not fuond!");
        }
    }
}

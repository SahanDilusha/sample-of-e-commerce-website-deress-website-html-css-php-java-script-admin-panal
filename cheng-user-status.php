<?php

include "connecton.php";

if (isset($_POST["st"]) || isset($_POST["username"])) {

    if ($_POST["st"] != "" && $_POST["username"] != "") {

        $checkuser = Database::search("SELECT * FROM `users` WHERE  `username` = '".$_POST["username"]."';");

        if ($checkuser->num_rows == 1) {
            

            if ($_POST["st"] != $checkuser->fetch_assoc()["stetus_stetus_id"]) {

                Database::iud("UPDATE `users` SET `users`.`stetus_stetus_id` = '" . $_POST["st"] . "' WHERE `username` = '".$_POST["username"]."';");
                echo ('status changed');
            }
        } else {
            echo ("Error: Invoice not fuond!");
        }
    }
}

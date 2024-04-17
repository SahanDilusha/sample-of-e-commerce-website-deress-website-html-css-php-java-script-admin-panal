<?php

include "connecton.php";

if (isset($_POST["st"]) || isset($_POST["id"])) {

    if ($_POST["st"] != "" && $_POST["id"] != "") {

        $checkInvoice = Database::search("SELECT * FROM `invoice` WHERE `invoice`.`invoice_id` = '" . $_POST["id"] . "';");

        if ($checkInvoice->num_rows == 1) {
            

            if ($_POST["st"] != $checkInvoice->fetch_assoc()["invoice_stetus"]) {

                Database::iud("UPDATE `invoice` SET `invoice`.`invoice_stetus` = '" . $_POST["st"] . "' WHERE `invoice`.`invoice_id` = '" . $_POST["id"] . "';");
                echo ('status changed');
            }
        } else {
            echo ("Error: Invoice not fuond!");
        }
    }
}

<?php

include "connecton.php";

if (isset($_POST["st"]) || isset($_POST["id"])) {

    if ($_POST["st"] != "" && $_POST["id"] != "") {

        $checkInvoice = Database::search("SELECT * FROM `invoice` WHERE `invoice`.`invoice_id` = '" . $_POST["id"] . "';");

        if ($checkInvoice->num_rows == 1) {
            $checkInvoice->fetch_assoc();

            if ($_POST["st"] !== $checkInvoice["stetus_stetus_id"]) {

                Database::iud("UPDATE `invoice` SET `invoice`.`stetus_stetus_id` = '" . $_POST["st"] . "' WHERE `invoice`.`invoice_id` = '" . $_POST["id"] . "';");
                echo ('status changed');
            }
        } else {
            echo ("Error: Invoice not fuond!");
        }
    }
}

<?php
include "connecton.php";

$id = $_POST["id"];

if ($id != "" || $id != null) {

    $getData = Database::search("SELECT * FROM `invoice_items` INNER JOIN `product` ON `invoice_items`.`product_id` = `product`.`id` WHERE
    `invoice_items`.`invoice_invoice_id` = '" . $id . "';");

    if ($getData->num_rows != 0) {

        $array = array();

        for ($i = 0; $i < $getData->num_rows; $i++) {

            $row = $getData->fetch_assoc();

            $object = new stdClass();

            $object->itemId = $row['item_id'];
            $object->itemName = $row['item_id'];
            $object->itemName = $row['item_id'];
            $object->itemPrice = $row['product_id'];
            $object->itemQty = $row['item_id'];

            array_push($array, $object);
        }
    }
}

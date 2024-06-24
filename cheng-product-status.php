<?php
include "connecton.php";

if (isset($_POST["id"]) && isset($_POST["st"])) {
    Database::iud("UPDATE `product` SET `product`.`stetus_stetus_id` = '" . $_POST["st"] . "' WHERE `product`.`id` = '" . $_POST["id"] . "';");
    echo ("ok");
} else {
    echo ("Error");
}

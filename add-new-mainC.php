<?php
include "connecton.php";

if (isset($_POST["text"]) && !empty($_POST["text"])) {
    Database::iud("INSERT INTO `main_category`(`main_category_name`)VALUES('" . $_POST["text"] . "');");
    echo ("ok");
} else {
    echo "please enter a category name!";
}
?>
<?php

include "connecton.php";

if (isset($_POST["username"])) {

    if ($_POST["username"] == "") {
        echo ("Error:User not found!");
    }
} else {
    echo ("Error:User not found!");
}

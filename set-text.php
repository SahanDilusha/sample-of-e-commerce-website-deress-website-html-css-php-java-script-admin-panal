<?php

$username = $_POST["username"];

if ($username == "") {
    $_COOKIE["text"] = "no";
} else {
    $_COOKIE["text"] = $username;
}

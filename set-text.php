<?php

$text = $_POST["text"];

if ($text == "") {
    setcookie("text","");
} else {
    setcookie("text", $text);
}
echo $text;
?>
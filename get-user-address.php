<?php

include "connecton.php";

if (isset($_POST["username"])) {

    if ($_POST["username"] == "") {
        echo ("Error:User not found!");
    } else {
        $data = Database::search("SELECT * FROM `user_address` INNER JOIN `city` ON `user_address`.`city_city_id` = `city`.`city_id` 
        INNER JOIN `district` ON `city`.`district_district_id` = `district`.`district_id` 
        WHERE `user_address`.`users_username` = '" . $_POST["username"] . "';");

        if ($data->num_rows !=0) {
            
            for ($i=0; $i < $data->num_rows; $i++) { 
                
                

            }

        }

    }
} else {
    echo ("Error:User not found!");
}

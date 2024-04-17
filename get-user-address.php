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

            $array = array();
            
            for ($i=0; $i < $data->num_rows; $i++) { 
                
              $row = $data->fetch_assoc();

              $object = new  stdClass;
              
              $object -> city_name = $row["city_name"];
              $object -> district_name = $row["district_name"];
              $object -> address =  $row["line_1"].", ".$row["line_2"];
              $object -> address_id = $row["address_id"];
              $object -> address_mobile = $row["address_mobile"];
             
              array_push($array, $object);

            }

            echo(json_encode($array));

        }

    }
} else {
    echo ("Error:User not found!");
}

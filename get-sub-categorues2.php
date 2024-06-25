<?php

include "connecton.php";

$q  = "SELECT * FROM `sub_category`";

if (isset($_GET["text"]) && !empty($_GET["text"])) {
    $q = $q . " WHERE `sub_categor_name` LIKE '" . $_GET["text"] . "%' OR `sub_categor_id` = '" . $_GET["text"] . "'";
}

$data = Database::search($q);

if ($data->num_rows !== 0) {

    for ($i = 0; $i < $data->num_rows; $i++) {

        $row = $data->fetch_assoc();

?>
        <tr>
            <td><?= $row["sub_categor_id"] ?></td>
            <td><?= $row["sub_categor_name"] ?></td>
        </tr>
    <?php

    }
} else { 


echo("no data fuond");   

}
?>
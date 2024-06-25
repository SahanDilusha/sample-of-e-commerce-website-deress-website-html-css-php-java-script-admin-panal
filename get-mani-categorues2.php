<?php

include "connecton.php";


$q = "SELECT * FROM `main_category`";


if (isset($_GET["text"]) && !empty($_GET["text"])) {
    $q = $q . " WHERE `main_category_name` LIKE '" . $_GET["text"] . "%' OR `main_category_id` = '" . $_GET["text"] . "'";
}

$data = Database::search($q);

if ($data->num_rows !== 0) {

    for ($i = 0; $i < $data->num_rows; $i++) {

        $row = $data->fetch_assoc();

?>
        <tr>
            <td><?= $row["main_category_id"] ?></td>
            <td><?= $row["main_category_name"] ?></td>
        </tr>
<?php

    }
} else {

    echo ("no data fuond");
}

?>
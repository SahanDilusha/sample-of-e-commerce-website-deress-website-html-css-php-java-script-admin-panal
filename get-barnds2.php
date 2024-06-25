<?php

include "connecton.php";

$q = "SELECT * FROM `brand`";

if (isset($_GET["text"]) && !empty($_GET["text"])) {
    $q = $q . " WHERE `brand_name` LIKE '" . $_GET["text"] . "%' OR `idbrand` = '" . $_GET["text"] . "'";
}

$data = Database::search($q);

if ($data->num_rows !== 0) {

    for ($i = 0; $i < $data->num_rows; $i++) {

        $row = $data->fetch_assoc();

?>
        <tr>
            <td><?= $row["idbrand"] ?></td>
            <td><?= $row["brand_name"] ?></td>
        </tr>
<?php

    }
} else {

    echo ("no data fuond");
}

?>
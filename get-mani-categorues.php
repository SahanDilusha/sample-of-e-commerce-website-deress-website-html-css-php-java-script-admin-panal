<?php

include "connecton.php";

$data = Database::search("SELECT * FROM `main_category`;");
?>
<option value='0'>Select</option>
<?php
if ($data->num_rows !== 0) {

    for ($i = 0; $i < $data->num_rows; $i++) {

        $row = $data->fetch_assoc();

?>
        <option value='<?= $row["main_category_id"] ?>'><?= $row["main_category_name"] ?></option>

<?php

    }
}



?>
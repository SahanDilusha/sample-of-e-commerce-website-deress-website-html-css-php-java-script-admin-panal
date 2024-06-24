<?php

include "connecton.php";

$data = Database::search("SELECT * FROM `sub_category`;");
?>
<option value='0'>Select</option>
<?php
if ($data->num_rows !== 0) {

    for ($i = 0; $i < $data->num_rows; $i++) {

        $row = $data->fetch_assoc();

?>
        <option value='<?= $row["sub_categor_id"] ?>'><?= $row["sub_categor_name"] ?></option>

<?php

    }
}



?>
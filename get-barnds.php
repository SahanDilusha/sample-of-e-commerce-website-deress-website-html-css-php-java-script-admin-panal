<?php
include "connecton.php";
$data = Database::search("SELECT * FROM `brand`;");
?>
<option value="0">Select</option>
<?php
for ($i = 0; $i < $data->num_rows; $i++) {
    $row = $data->fetch_assoc();
?>
    <option value="<?= $row["idbrand"] ?>"><?= $row["brand_name"] ?></option>
<?php
}
?>
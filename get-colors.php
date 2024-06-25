<?php
include "connecton.php";
$data = Database::search("SELECT `colors_id`,`colors_name` FROM `product_colors`;");
?>
<option value="0">Select</option>
<?php
for ($i = 0; $i < $data->num_rows; $i++) {
    $row = $data->fetch_assoc();
?>
    <option value="<?= $row["colors_id"] ?>"><?= $row["colors_name"] ?></option>
<?php
}
?>
<?php
include "connecton.php";

$q = "SELECT * FROM `invoice` INNER JOIN `users` ON `invoice`.`users_username` = `users`.`username` INNER JOIN `user_address` ON `invoice`.`user_address_address_id` = `user_address`.`address_id` INNER JOIN `city` ON `user_address`.`city_city_id` = `city`.`city_id`";

if (isset($_POST["id"])) {

    if ($_POST["id"] != '') {

        if (strpos("WHERE", $q) == false) {
            $q = $q . "WHERE";
        }

        $q = $q . "`invoice_id` = '" . $_POST["id"] . "'";
    }
}

$si = 1;

if (isset($_POST["fl"])) {

    if ($_POST["fl"] == "11") {
        if (strpos("WHERE", $q) == false) {
            $q = $q . "WHERE";
        }
        $si = 11;
        $q = $q . "`invoice`.`invoice_stetus` = '11'";  //show all Processing
    } else if ($_POST["fl"] == "12") {
        $si = 12;
        if (strpos("WHERE", $q) == false) {
            $q = $q . "WHERE";
        }
        $q = $q . "`invoice`.`invoice_stetus` = '12'";  //show all On Packing
    } else if ($_POST["fl"] == "13") {
        if (strpos("WHERE", $q) == false) {
            $q = $q . "WHERE";
        }
        $si = 13;
        $q = $q . "`invoice`.`invoice_stetus` = '13'";  //show all On Shiping
    } else if ($_POST["fl"] == "14") {
        if (strpos("WHERE", $q) == false) {
            $q = $q . "WHERE";
        }
        $si = 14;
        $q = $q . "`invoice`.`invoice_stetus` = '14'";  //show all Delivered
    } else if ($_POST["fl"] == "9") {
        if (strpos("WHERE", $q) == false) {
            $q = $q . "WHERE";
        }
        $si = 9;
        $q = $q . "`invoice`.`invoice_stetus` = '9'";  //show all Delivered
    }
}

$getInvoice = Database::search($q);

if ($getInvoice->num_rows != 0) {

    for ($i = 0; $i < $getInvoice->num_rows; $i++) {

        $row = $getInvoice->fetch_assoc();

        $getItemCount = Database::search("SELECT COUNT(`invoice_items_id`) AS `count` FROM `invoice_items` WHERE `invoice_invoice_id` = '" . $row["invoice_id"] . "';");
?>
        <tr>
            <td>
                <?= $row["invoice_id"]; ?>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <img src="http://localhost/MyShop/profile_images/<?= $row["username"]; ?>.png" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                    <div class="ms-3">
                        <p class="fw-bold mb-1"><?= $row["username"]; ?></p>
                        <p class="text-muted mb-0"><?= $row["email"]; ?></p>
                    </div>
                </div>
            </td>

            <td>
                <?= "No." . $row["line_1"] . ", " . $row["line_2"] . ", " . $row["city_name"] ?>
            </td>
            <td>
                <?= $row["address_mobile"]; ?>
            </td>
            <td>
                <?php if ($getItemCount->num_rows != 0) {
                    echo ($getItemCount->fetch_assoc()["count"]);
                } ?>
            </td>
            <td><?= $row["grand_total"]; ?></td>
            <td><?=$row["date"];?></td>
            <td><select class="form-select" aria-label="Default select example" id="get_status" onchange="chengInvoiceStatus('<?= $row['invoice_id']; ?>');">
                    <option value="11" <?php if ($row["invoice_stetus"] == "11") {
                                        ?> selected <?php
                                                } ?>>Processing</option>
                    <option value="12" <?php if ($row["invoice_stetus"] == "12") {
                                        ?> selected <?php
                                                } ?>>On Packing</option>
                    <option value="13" <?php if ($row["invoice_stetus"] == "13") {
                                        ?> selected <?php
                                                } ?>>On Shiping</option>
                    <option value="14" <?php if ($row["invoice_stetus"] == "14") {
                                        ?> selected <?php
                                                } ?>>Delivered</option>
                    <option value="9" <?php if ($row["invoice_stetus"] == "9") {
                                        ?> selected <?php
                                                } ?>>Cancel</option>
                </select></td>                
        </tr>

<?php }
} ?>
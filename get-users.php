<?php 
include "connecton.php";

$q = "SELECT * FROM `users`";

if (isset($_POST['search'])) {
    if ($_POST['search'] != '') {
        $q = $q . ' WHERE `username` LIKE "%' . $_POST['search'] . '%"';
    }
}

if (isset($_POST["fl"])) {

    if ($_POST["fl"] != "0" & $_POST["fl"] != "") {
        $q = $q . "WHERE `stetus_stetus_id` = '" . $_POST['fl'] . "' ";
    }
}

$getUsers = Database::search($q);

if ($getUsers->num_rows != 0) {

    for ($i = 0; $i < $getUsers->num_rows; $i++) {

        $row = $getUsers->fetch_assoc();

?>
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <?php
                    if ($row["stetus_dp"] == "2") {
                    ?>
                        <img src="http://localhost/myshop-admin/profile_images/d.png" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                    <?php
                    } else {
                    ?>
                        <img src="http://localhost/MyShop/profile_images/<?= $row["username"]; ?>.png" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                    <?php
                    }
                    ?>
                    <div class="ms-3">
                        <p class="fw-bold mb-1"><?= $row["username"]; ?></p>
                    </div>
                </div>
            </td>
            <td>
                <?= $row["first_name"]; ?>
            </td>
            <td>
                <?= $row["last_name"]; ?>
            </td>
            <td>
                <?= $row["mobile"]; ?>
            </td>
            <td>
                <?= $row["email"]; ?>
            </td>
            <td>
                <?= $row["r_date"]; ?>
            </td>
            <td><select class="form-select" onchange="chengUserStatus('<?= $row['username']; ?>');" id="get_status1">
                    <option value="1" <?php if ($row["stetus_stetus_id"] == "1") {
                                        ?> selected <?php
                                                } ?>>Active</option>
                    <option value="6" <?php if ($row["stetus_stetus_id"] == "6") {
                                        ?> selected <?php
                                                } ?>>Disable</option>
                    <option value="4" <?php if ($row["stetus_stetus_id"] == "4") {
                                        ?> selected <?php
                                                } ?>>Delete</option>
                </select></td>
        </tr>

<?php }
} ?>
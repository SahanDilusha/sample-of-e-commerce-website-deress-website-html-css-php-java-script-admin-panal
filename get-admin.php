<?php

include "connecton.php";

session_start();

$q = "SELECT * FROM `system_login` WHERE `system_login_username` !='" . $_SESSION["user2"]["system_login_username"] . "'";

if (isset($_POST['search'])) {
    if ($_POST['search'] != '') {
        $q = $q . 'AND  `system_login_username` LIKE "%' . $_POST['search'] . '%"';
    }
}

if (isset($_POST["fl"])) {

    if ($_POST["fl"] != "0" & $_POST["fl"] != "") {
        $q = $q . "AND `stetus_stetus_id` = '" . $_POST['fl'] . "' ";
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
                        <img src="http://localhost/MyShop/profile_images/<?= $row["system_login_username"]; ?>.png" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                    <?php
                    }
                    ?>
                    <div class="ms-3">
                        <p class="fw-bold mb-1"><?= $row["system_login_username"]; ?></p>
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
                <?= $row["system_login_r_date"]; ?>
            </td>
            <td><select class="form-select" onchange="chengAdminStatus('<?= $row['system_login_username']; ?>');" id="get_status1">
                    <option value="1" <?php if ($row["stetus_stetus_id"] == "1") {
                                        ?> selected <?php
                                                } ?>>Active</option>
                    <option value="6" <?php if ($row["stetus_stetus_id"] == "6") {
                                        ?> selected <?php
                                                } ?>>Disable</option>
                </select></td>
        </tr>

<?php }
} ?>
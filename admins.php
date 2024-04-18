<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins</title>
    <link rel="icon" href="resources/image/Logo.png" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <?php

    include "navbar.php";
    if (!isset($_SESSION["user"])) {
        header("Location: http://localhost/myshop-admin/index.php");
        exit;
    } else {

        include "connecton.php";
        include "spinners.php";
        include "toast.php";

        $q = "SELECT * FROM `system_login` WHERE `system_login_username` !='" . $_SESSION["user"]["system_login_username"] . "'";

        if (isset($_GET['search'])) {
            if ($_GET['search'] != '') {
                $q = $q . 'AND  `system_login_username` LIKE "%' . $_GET['search'] . '%"';
            }
        }

        if (isset($_GET["fl"])) {

            if ($_GET["fl"] != "0" & $_GET["fl"] != "") {
                $q = $q . "AND `stetus_stetus_id` = '" . $_GET['fl'] . "' ";
            }
        }

        $getUsers = Database::search($q);

    ?>

        <div class="container-fluid overflow-x-hidden">
            <div class="row">
                <div class="col-12 overflow-x-scroll mt-5">

                    <h4 class="fw-bold">Admins(<?= $getUsers->num_rows; ?>)</h4>

                    <div class="d-flex  w-100 mt-4 mb-4 justify-content-between align-items-center">

                        <div class="d-flex gap-2">
                            <input class="form-control me-2" type="search" value="<?php if (isset($_GET['search'])) {
                                                                                        echo ($_GET['search']);
                                                                                    } ?>" id="searchField" placeholder="Username" aria-label="Search">
                            <button class="btn btn-dark" onclick="searchAdmins();">Search</button>
                        </div>

                        <div class="d-flex gap-2">
                            <select class="form-select" id="get_status">
                                <option value="0" <?php if (isset($_GET["fl"])) {
                                                        if ($_GET["fl"] == "0") {
                                                    ?> selected <?php
                                                            }
                                                        } ?>>All</option>
                                <option value="1" <?php if (isset($_GET["fl"])) {
                                                        if ($_GET["fl"] == "1") {
                                                    ?> selected <?php
                                                            }
                                                        } ?>>Active</option>
                                <option value="6" <?php if (isset($_GET["fl"])) {
                                                        if ($_GET["fl"] == "6") {
                                                    ?> selected <?php
                                                            }
                                                        } ?>>Disable</option>
                                <option value="4" <?php if (isset($_GET["fl"])) {
                                                        if ($_GET["fl"] == "4") {
                                                    ?> selected <?php
                                                            }
                                                        } ?>>Delete</option>
                            </select>
                            <button class="btn btn-dark" onclick="flAdmin();">Apply</button>
                        </div>

                    </div>

                    <div class="w-100 mb-3 d-flex justify-content-end">
                        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#addAdminModle">Add New Admin</button>
                    </div>

                    <table class="table align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Registered Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
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
                                                <option value="4" <?php if ($row["stetus_stetus_id"] == "4") {
                                                                    ?> selected <?php
                                                                            } ?>>Delete</option>
                                            </select></td>
                                    </tr>

                            <?php }
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addAdminModle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAdminModleLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addAdminModleLabel">Add New Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 mb-2">
                                <label for="new_email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="new_email">
                            </div>
                            <div class="col-12 mb-2">
                                <label for="new_fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="new_fname">
                            </div>
                            <div class="col-12 mb-2">
                                <label for="new_lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="new_lname">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" onclick="addNewAddmin();">Add</button>
                    </div>
                </div>
            </div>
        </div>


        <?php
        include "modle-erro.php";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="script.js"></script>

</body>

</html>

<?php } ?>
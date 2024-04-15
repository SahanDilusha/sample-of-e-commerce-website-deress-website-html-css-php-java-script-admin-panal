<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="icon" href="resources/image/Logo.png" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <?php
    include "spinners.php";
    include "navbar.php";
    if (!isset($_SESSION["user"])) {
        header("Location: http://localhost/myshop-admin/index.php");
        exit;
    } else {

        include "connecton.php";

        $q = "SELECT * FROM `invoice` INNER JOIN `users` ON `invoice`.`users_username` = `users`.`username` INNER JOIN `user_address` ON `invoice`.`user_address_address_id` = `user_address`.`address_id` INNER JOIN `city` ON `user_address`.`city_city_id` = `city`.`city_id`";

        if (isset($_GET["id"]) & $_GET["id"]!='') {
            $q = $q . "AND `invoice_id` = '" . $_GET["id"] . "';";
        }

        $getInvoice = Database::search($q);

    ?>

        <div class="container-fluid overflow-x-hidden">
            <div class="row">

                <div class="d-flex w-50 mt-4 mb-4">
                    <input class="form-control me-2" type="text" value="<?php if (isset($_GET["id"])) {
                                                                                echo ($_GET["id"]);
                                                                            } ?>" id="searchField" placeholder="Username" />
                    <button class="btn btn-dark" onclick="searchInvoice();">Search</button>
                </div>

                <div class="col-12 overflow-x-scroll mt-5">

                    <h4 class="fw-bold">Orders</h4>

                    <table class="table align-middle mb-0 bg-white" id="in_item">
                        <thead class="bg-light">
                            <tr>
                                <th>Invoice No.</th>
                                <th>Username</th>
                                <th>Address</th>
                                <th>Mobile</th>
                                <th>Total Items</th>
                                <th>Grand Total(LKR)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
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
                                        <td><select class="form-select" aria-label="Default select example">
                                                <option value="1" selected>Active</option>
                                                <option value="2">Processing</option>
                                                <option value="3">On Packing</option>
                                                <option value="4">On Shiping</option>
                                                <option value="5">Diliverd</option>
                                                <option value="6">Cancel</option>
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
        <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Invoice Items</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="in_id" class="form-label">Invoice Id</label>
                                        <input type="text" class="form-control" id="in_id" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="in_username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="in_username" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="in_qty" class="form-label">Total Items</label>
                                        <input type="text" class="form-control" id="in_qty" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Grand Total(LKR)</label>
                                        <input type="text" class="form-control" id="in_grand" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="in_status" class="form-label">Status</label>
                                        <select class="form-select" id="in_status">
                                            <option value="1" selected>Active</option>
                                            <option value="2">Processing</option>
                                            <option value="3">On Packing</option>
                                            <option value="4">On Shiping</option>
                                            <option value="5">Diliverd</option>
                                            <option value="6">Cancel</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 overflow-x-scroll">
                                    <table class="table align-middle mb-0 bg-white">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Item Id</th>
                                                <th>Product Name</th>
                                                <th>QTY</th>
                                                <th>Item Price(LKR)</th>
                                                <th>Total(LKR)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="modalTableBody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
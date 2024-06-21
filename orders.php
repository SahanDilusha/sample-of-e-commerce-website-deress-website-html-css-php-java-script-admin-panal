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

<body onload="searchInvoice();">

    <?php
    include "spinners.php";
    include "navbar.php";
    if (!isset($_SESSION["user2"])) {
        header("Location: http://localhost/myshop-admin/index.php");
        exit;
    } else {

        include "connecton.php";

    ?>

        <div class="container-fluid overflow-x-hidden">
            <div class="row">

                <div class="w-100 mt-4 mb-4">

                    <h4 class="fw-bold">Orders</h4>

                </div>

                <div class="col-12 d-flex justify-content-between align-items-center">

                    <div class="d-flex w-100 mt-2 mb-2 justify-content-between align-items-center">

                        <div class="d-flex gap-2">
                            <input class="form-control me-2" type="text" id="searchField" placeholder="Invoice No" onkeyup="searchInvoice();"/>
                            <button class="btn btn-dark" onclick="searchInvoice();">Search</button>
                        </div>

                        <div class="d-flex gap-2">
                            <select class="form-select" id="fl" onchange="searchInvoice();">
                                <option value="1" selected >All</option>
                                <option value="11">Processing</option>
                                <option value="12">On Packing</option>
                                <option value="13">On Shiping</option>
                                <option value="14">Delivered</option>
                                <option value="9">Cancel</option>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="col-12 overflow-x-scroll mt-5">

                    <table class="table table-bordered table-hover align-middle mb-0 bg-white" id="in_item">
                        <thead class="table-dark">
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
                        <tbody id="in_table_body">

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
                                            <option value="1" selected>All</option>
                                            <option value="11">Processing</option>
                                            <option value="12">On Packing</option>
                                            <option value="13">On Shiping</option>
                                            <option value="14">Delivered</option>
                                            <option value="9">Cancel</option>
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
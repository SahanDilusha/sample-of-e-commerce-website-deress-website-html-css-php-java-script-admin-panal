<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="icon" href="resources/image/Logo.png" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body onload="searchUsers();">

    <?php

    include "navbar.php";
    if (!isset($_SESSION["user2"])) {
        header("Location: http://localhost/myshop-admin/index.php");
        exit;
    } else {

        include "connecton.php";
        include "spinners.php";

    ?>

        <div class="container-fluid overflow-x-hidden">
            <div class="row">
                <div class="col-12 overflow-x-scroll mt-5">

                    <h4 class="fw-bold" id="us-count"></h4>

                    <div class="d-flex w-100 mt-4 mb-4 justify-content-between align-items-center">

                        <div class="d-flex gap-2">
                            <input class="form-control me-2" type="search" id="searchField" placeholder="Username" aria-label="Search" onkeydown="searchUsers();">
                            <button class="btn btn-dark" onclick="searchUsers();">Search</button>
                        </div>

                        <div class="d-flex gap-2">
                            <select class="form-select" id="get_status" onclick="searchUsers();">
                                <option value="0" selected>All</option>
                                <option value="1">Active</option>
                                <option value="6">Disable</option>
                                <option value="4">>Delete</option>
                            </select>
                        </div>

                    </div>

                    <table class="table table-bordered table-hover align-middle mb-0 bg-white" id="user_table">
                        <thead class="table-dark">
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
                        <tbody id="userTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="user_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="user_modalLabel">User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="in_id" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="in_username" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="in_username" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="in_firstname" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="in_qty" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="in_lastname" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Mobile</label>
                                        <input type="text" class="form-control" id="in_mobile" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="in_email" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="in_status" class="form-label">Status</label>
                                        <select class="form-select" id="in_status" disabled>
                                            <option value="1" selected>Active</option>
                                            <option value="6">Disable</option>
                                            <option value="4">Delete</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 overflow-x-scroll">
                                    <table class="table align-middle mb-0 bg-white">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Address Id</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>District</th>
                                                <th>Mobile</th>
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
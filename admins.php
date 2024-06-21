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

<body onload="searchAdmins();">

    <?php

    include "navbar.php";
    if (!isset($_SESSION["user2"])) {
        header("Location: http://localhost/myshop-admin/index.php");
        exit;
    } else {

        include "connecton.php";
        include "spinners.php";
        include "toast.php";

    ?>

        <div class="container-fluid overflow-x-hidden">
            <div class="row">
                <div class="col-12 overflow-x-scroll mt-5">

                    <h4 class="fw-bold" id="us_count"></h4>

                    <div class="d-flex  w-100 mt-4 mb-4 justify-content-between align-items-center">

                        <div class="d-flex gap-2">
                            <input class="form-control me-2" type="search" id="searchField" placeholder="Username"  onkeyup="searchAdmins();">
                            <button class="btn btn-dark" onclick="searchAdmins();">Search</button>
                        </div>

                        <div class="d-flex gap-2">
                            <select class="form-select" id="get_status" onchange="searchAdmins();">
                                <option value="0" selected>All</option>
                                <option value="1">Active</option>
                                <option value="6">Disable</option>
                            </select>
                        </div>

                    </div>

                    <div class="w-100 mb-3 d-flex justify-content-end">
                        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#addAdminModle">Add New Admin</button>
                    </div>

                    <table class="table table-bordered align-middle table-hover">
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
                        <tbody id="adminTableBody">

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
                            <div class="col-12 mb-2">
                                <label for="new_lname" class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="new_mobile">
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
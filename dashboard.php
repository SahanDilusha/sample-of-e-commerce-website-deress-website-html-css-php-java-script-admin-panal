<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

    ?>

        <div class="container mt-5 mb-5">
            <div class="row d-flex gap-3 justify-content-center align-items-center">
                <div class="col-md-3 col-lg-3 d1 p-4 d-flex rounded-3">
                    <div class="w-25 d-flex justify-content-center align-items-center">
                        <i class="bi bi-truck fs-1 text-white"></i>
                    </div>
                    <div class="w-75">
                        <h5 class="text-center fw-bold pt-3 ps-3">New Orders</h5>
                        <h3 class="text-center">10</h3>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 d2 p-4 d-flex rounded-3">
                    <div class="w-25 d-flex justify-content-center align-items-center">
                        <i class="bi bi-cash-coin fs-1 text-white"></i>
                    </div>
                    <div class="w-75">
                        <h5 class="text-center fw-bold pt-3 ps-3">Total  Revenue</h5>
                        <h3 class="text-center">10</h3>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 d3 p-4 d-flex rounded-3">
                    <div class="w-25 d-flex justify-content-center align-items-center">
                        <i class="bi bi-people-fill fs-1 text-white"></i>
                    </div>
                    <div class="w-75">
                        <h5 class="text-center fw-bold pt-3 ps-3">Total Users</h5>
                        <h3 class="text-center">10</h3>
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
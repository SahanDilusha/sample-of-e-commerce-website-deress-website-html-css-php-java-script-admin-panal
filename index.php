<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: http://localhost/myshop-admin/dashboard.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Krist Admin Login</title>
    <link rel="icon" href="resources/image/Logo.png" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body class="bg-body-secondary">

    <div class="container-fluid min-vh-100">

        <div class="row d-flex flex-column justify-content-center align-items-center min-vh-100">
            <div class="col-11 col-md-6 p-3 bg-white rounded-3 col-lg-4 d-flex flex-column justify-content-center align-items-center">
                <img src="resources/image/Logo.png" alt="">

                <div class="w-100 mt-4 mb-4">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" required />
                    </div>
                    <div class="mb-3 mt-3 w-75">
                        <label for="password" class="col-sm-2 col-form-label text-black">Password</label>
                        <div class="">
                            <input type="password" class="form-control" id="password" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button class="btn btn-dark px-3" onclick="Login();">Login</button>
                        <button class="btn bg-transparent border-0 text-primary fw-bold">forgot password?</button>
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
<?php

session_start();

?>

<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="resources/image/Logo_white.png" alt="nav-logo" width="100px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-products.php">Manege Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admins.php">Admins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Messages</a>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-danger" onclick="Logout();">Logout</button>
                </li>
            </ul>

            <a href="admin-profile.php" class="px-2 text-decoration-none d-flex justify-content-center align-items-center gap-2">

                <?php
                if ($_SESSION["user2"]["stetus_dp"] == "1") {
                ?>
                    <img src="profile_images/<?= $_SESSION["user2"]["system_login_username"] ?>.png" class="rounded-5" alt="p-img" width="40px" />
                <?php
                } else {
                ?>
                    <img src="resources/image/default_profile.png" class="rounded-5" alt="p-img" width="40px" />
                <?php
                }
                ?>

                <label class="fw-bold text-white"><?= $_SESSION["user2"]["system_login_username"] ?></label>
            </a>

        </div>
    </div>
</nav>
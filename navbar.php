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
                    <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manege Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Admins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Messages</a>
                </li>
            </ul>

            <a href="#" class="px-2 text-decoration-none d-flex justify-content-center align-items-center gap-2">
                <img src="profile_images/pwani.png" class="rounded-5" alt="p-img" width="40px" />
                <label class="fw-bold text-white"><?= $_SESSION["user"]["system_login_username"] ?></label>
            </a>

        </div>
    </div>
</nav>
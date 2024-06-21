<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="icon" href="resources/image/Logo.png">
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include "navbar.php";
    if (!isset($_SESSION["user2"])) {
        header("Location: http://localhost/myshop-admin/index.php");
        exit;
    } else {

        include "spinners.php";
        $user = $_SESSION["user2"];

    ?>

        <div class="container-fluid">
            <div class="row">
                <!-- Main Content -->
                <main class="col-12 ms-sm-auto px-md-4">
                    <!-- Profile Header -->
                    <div class="profile-header d-flex align-items-center">
                        <?php
                        if ($_SESSION["user2"]["stetus_dp"] == "1") {
                        ?>
                            <img src="profile_images/<?= $_SESSION["user2"]["system_login_username"] ?>.png" alt="Admin Avatar" class="me-3" />
                        <?php
                        } else {
                        ?>
                            <img src="resources/image/default_profile.png" alt="Admin Avatar" class="me-3" />
                        <?php
                        }
                        ?>

                        <div>
                            <h2><?= $user["first_name"] ?> <?= $user["last_name"] ?></h2>

                            <p class="mb-0"><?= $user["email"] ?></p>
                        </div>
                    </div>

                    <!-- Profile Details and Settings -->
                    <div class="content">
                        <div class="row">
                            <!-- Personal Details -->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-dark text-white">
                                        <h5 class="mb-0">Personal Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="mb-3">
                                                <label for="firstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstName" value="<?= $user["first_name"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="lastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastName" value="<?= $user["last_name"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" value="<?= $user["email"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" value="<?= $user["mobile"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Profile Image</label>
                                                <input type="file" class="form-control" id="p_img">
                                            </div>
                                            <button type="submit" class="btn btn-primary" onclick="updateAdmin();">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Account Settings -->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-dark text-white">
                                        <h5 class="mb-0">Account Settings</h5>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="mb-3">
                                                <label for="currentPassword" class="form-label">Current Password</label>
                                                <input type="password" class="form-control" id="currentPassword">
                                            </div>
                                            <div class="mb-3">
                                                <label for="newPassword" class="form-label">New Password</label>
                                                <input type="password" class="form-control" id="newPassword">
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                                <input type="password" class="form-control" id="confirmPassword">
                                            </div>
                                            <div class="">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Two-Step Verification -->
                                <div class="card mt-4">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0">Two-Step Verification (2FA)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-check-label">
                                                <?php
                                                if ($user["two_step"] == "1") {
                                                    echo ("Diable Two-Step Verification");
                                                } else {
                                                    echo ("Enable Two-Step Verification");
                                                }
                                                ?>
                                            </label>
                                        </div>

                                        <?php
                                        if ($user["two_step"] == "1") {
                                        ?>
                                            <button class="btn btn-danger" onclick="VerificationCheng('6');">Diable</button>
                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn btn-primary" onclick="VerificationCheng('1');">Setup 2FA</button>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-header bg-danger text-white">
                                        <h5 class="mb-0">Deactivate Account</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>If you deactivate your account, you will not be able to log in again.</p>
                                        <button class="btn btn-danger" onclick="DeactivateAccount();">Deactivate Account</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <?php
        include "modle-erro.php";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="script.js"></script>
</body>

</html>
<?php  } ?>
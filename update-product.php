<?php
include "connecton.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialize error array
    $errors = [];

    // Sanitize and validate product name
    $productName = htmlspecialchars(trim($_POST['m_productName']));
    if (empty($productName)) {
        $errors[] = "Product name is required.";
    }

    // Validate product price
    $productPrice = filter_input(INPUT_POST, 'm_productPrice', FILTER_VALIDATE_FLOAT);
    if ($productPrice === false || $productPrice <= 0) {
        $errors[] = "Valid product price is required.";
    }

    // Validate product discount
    $productDiscount = filter_input(INPUT_POST, 'm_productDiscount', FILTER_VALIDATE_FLOAT);
    if ($productDiscount === false || $productDiscount < 0 || $productDiscount > 100) {
        $errors[] = "Valid discount percentage is required (0-100).";
    }

    // Sanitize delivery
    $delivery = filter_input(INPUT_POST, 'm_delivery', FILTER_VALIDATE_FLOAT);
    if ($delivery === false || $delivery <= 0) {
        $errors[] = "Valid product delivery price is required.";
    }

    $qty = filter_input(INPUT_POST, 'm_qty', FILTER_VALIDATE_FLOAT);
    if ($qty === false || $qty <= 0) {
        $errors[] = "Valid product qty is required.";
    }
    // Sanitize product description
    $productDescription = htmlspecialchars(trim($_POST['m_description']));
    if (empty($productDescription)) {
        $errors[] = "Product description is required.";
    }

    // Sanitize main category
    $mainCategory = htmlspecialchars(trim($_POST['m_productMainCategory']));
    if (empty($mainCategory)) {
        $errors[] = "Main category is required.";
    }

    // Sanitize sub category
    $subCategory = htmlspecialchars(trim($_POST['m_productSubCategory']));
    if (empty($subCategory)) {
        $errors[] = "Sub category is required.";
    }

    // Sanitize color
    $color = htmlspecialchars(trim($_POST['m_productColor']));
    if (empty($color)) {
        $errors[] = "Color is required.";
    }

    // Additional fields to sanitize and validate if needed

    if (empty($errors)) {

        $productId = htmlspecialchars(trim($_POST['m_productId']));

        // Prepare and execute the query
        $query = "UPDATE `product` SET 
                    `product_name` = '$productName',
                    `product_price` = '$productPrice',
                    `product_discount` = '$productDiscount',
                    `delivery` = '$delivery',
                    `product_description` = '$productDescription',
                    `main_category_id` = '$mainCategory',
                    `sub_category_id` = '$subCategory',
                    `product_colors_id` = '$color',
                    `product_qty` = '$qty'
                  WHERE `id` = '$productId'";

        Database::iud($query);
        echo "ok";
    } else {
        // Output errors if any
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
} else {
    // If the request method is not POST
    echo "Invalid request.";
}

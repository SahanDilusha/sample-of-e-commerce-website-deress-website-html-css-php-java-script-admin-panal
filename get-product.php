<?php
include "connecton.php";



$q = "SELECT `id`,`product_name`,`main_category_name`,`sub_categor_name`,`colors_name`,`color_code`,`product_description`,`product_qty`,`product_price`,`product_discount`,`stetus_stetus_id`,`brand_name`,`delivery` FROM `product` 
INNER JOIN `main_category` ON `product`.`main_category_id` = `main_category`.`main_category_id`
INNER JOIN `sub_category` ON `product`.`sub_category_id` = `sub_category`.`sub_categor_id`
INNER JOIN `brand` ON `product`.`brand_idbrand` = `brand`.`idbrand`
INNER JOIN `product_colors` ON `product`.`product_colors_id` = `product_colors`.`colors_id`
WHERE `product`.`product_name` LIKE '" . $_GET["search"] . "%'";

$dateProduct =  Database::search($q);

if ($dateProduct->num_rows === 0) {
    # code...
} else {

    for ($i = 0; $i < $dateProduct->num_rows; $i++) {

        $row = $dateProduct->fetch_assoc();

?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['product_name']; ?></td>
            <td><?= $row["product_price"]; ?></td>
            <td><?= $row["product_discount"]; ?></td>
            <td><?= $row["main_category_name"]; ?></td>
            <td><?= $row["sub_categor_name"]; ?></td>
            <td class="d-none"><?= $row["color_code"]; ?></td>
            <td><?= $row["colors_name"]; ?></td>
            <td>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#productModal">Edit</button>
                <?php

                if ($row["stetus_stetus_id"] === "1") {
                ?>
                    <button class="btn btn-danger btn-sm" onclick="chengStatusProduct('<?= $row['id']; ?>','6')">Disable</button>
                <?php
                } else {
                ?>
                    <button class="btn btn-secondary btn-sm" onclick="chengStatusProduct('<?= $row['id']; ?>','1')">Active</button>

                <?php
                }

                ?>
            </td>
        </tr>
<?php

    }
}

?>
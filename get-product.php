<?php
include "connecton.php";

$q = "SELECT `id`,`product_name`,`material_name`,`main_category_name`,`sub_categor_name`,`colors_name`,`color_code`,`product_description`,`product_qty`,`product_price`,`product_discount`,`stetus_stetus_id`,`brand_name`,`delivery` FROM `product` 
INNER JOIN `main_category` ON `product`.`main_category_id` = `main_category`.`main_category_id`
INNER JOIN `sub_category` ON `product`.`sub_category_id` = `sub_category`.`sub_categor_id`
INNER JOIN `brand` ON `product`.`brand_idbrand` = `brand`.`idbrand`
INNER JOIN `product_colors` ON `product`.`product_colors_id` = `product_colors`.`colors_id`
INNER JOIN `material` ON `product`.`material_material_id` = `material`.`material_id`
WHERE `product`.`product_name` LIKE '" . $_GET["search"] . "%'";

if (isset($_GET["mc"]) && !empty($_GET["mc"]) && $_GET["mc"] !== "0") {
    $q = $q . "AND  `product`.`main_category_id` = '" . $_GET["mc"] . "'";
}

if (isset($_GET["su"]) && !empty($_GET["su"]) && $_GET["su"] !== "0") {
    $q = $q . "AND `sub_category_id` = '" . $_GET["su"] . "'";
}

$q = $q . "ORDER BY `id` ASC ";

$dateProduct =  Database::search($q);

if ($dateProduct->num_rows === 0) {
    # code...
} else {

    for ($i = 0; $i < $dateProduct->num_rows; $i++) {

        $row = $dateProduct->fetch_assoc();

        $getSum = Database::search("SELECT SUM(`qty`) AS `sum` FROM `invoice_items` WHERE `product_id` = '" . $row['id'] . "'");

        $sum = $getSum->fetch_assoc()['sum'];

        if ($sum ===null) {
            $sum = 0;
        }
?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['product_name']; ?></td>
            <td><?= $row["product_price"]; ?></td>
            <td><?= $row["product_discount"]; ?></td>
            <td><?= $row["delivery"]; ?></td>
            <td><?= $row["product_qty"]; ?></td>
            <td><?= $row["brand_name"]; ?></td>
            <td><?= $row["main_category_name"]; ?></td>
            <td><?= $row["sub_categor_name"]; ?></td>
            <td><?= $row["colors_name"]; ?></td>
            <td><?= $row["material_name"]; ?></td>
            <td><?= $sum; ?></td>
            <td class="d-none"><?= $row["product_description"]; ?></td>
            <td>
                <?php

                if ($row["stetus_stetus_id"] === "1") {
                ?>
                    Active <button class="btn btn-danger btn-sm" onclick="chengStatusProduct('<?= $row['id']; ?>','6')">Disable</button>
                <?php
                } else {
                ?>
                    Disable <button class="btn btn-secondary btn-sm" onclick="chengStatusProduct('<?= $row['id']; ?>','1')">Active</button>

                <?php
                }

                ?>
            </td>
        </tr>
<?php

    }
}

?>
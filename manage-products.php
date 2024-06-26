<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="icon" href="resources/image/Logo.png" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body onload="getProduct(); getSubCa(); getMainCa(); getMainCategories(); getSubCategories(); getColors(); getMaterial(); getBrands(); getBrand2();">
    <!-- Navigation Bar -->
    <?php include "navbar.php";

    if (!isset($_SESSION["user2"])) {
        header("Location: http://localhost/myshop-admin/index.php");
        exit;
    }

    include "spinners.php";
    ?>

    <!-- Main Content -->
    <div class="container-fluid mt-5">
        <h4 class="mb-4">Manage Products</h4>

        <!-- Search and Filter Controls -->
        <div class="row mb-4 d-flex justify-content-center align-items-center">
            <div class="col-md-2">
                <label for="searchField">Search</label>
                <input type="search" class="form-control" id="searchField" onkeyup="getProduct();" placeholder="Search products...">
            </div>
            <div class="col-md-2">
                <label for="filterCategory">Main Category</label>
                <select class="form-select" id="filterCategory" onchange="getProduct();">

                </select>
            </div>
            <div class="col-md-2">
                <label for="filterCategory">Sub Category</label>
                <select class="form-select" id="filterSuCategory" onchange="getProduct();">

                </select>
            </div>
            <div class="col-md-2 mt-3">
                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#productModal2">Add Product</button>
            </div>
            <div class="col-md-2 mt-3">
                <button class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#productCategoryModal2">Manage Category</button>
            </div>

            <div class="col-md-2 mt-3">
                <button class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#productBrandModal2">Manage Brands</button>
            </div>
        </div>

        <!-- Product Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle table-hover" id="productTable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price(Rs.)</th>
                        <th>Discount(%)</th>
                        <th>Delivery(Rs.)</th>
                        <th>Stock</th>
                        <th>Brand Name</th>
                        <th>Main Category</th>
                        <th>Sub Category</th>
                        <th>Color</th>
                        <th>Material</th>
                        <th>Sales</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productTbaleBody">
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="m_productId" name="m_productId">
                    <div class="mb-3">
                        <label for="m_productName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="m_productName" name="m_productName">
                    </div>
                    <div class="mb-3">
                        <label for="m_productPrice" class="form-label">Price (Rs.)</label>
                        <input type="number" class="form-control" id="m_productPrice" name="m_productPrice">
                    </div>
                    <div class="mb-3">
                        <label for="m_delivery" class="form-label">Delivery (Rs.)</label>
                        <input type="number" class="form-control" id="m_delivery" name="m_delivery">
                    </div>
                    <div class="mb-3">
                        <label for="m_productDiscount" class="form-label">Discount (%)</label>
                        <input type="number" class="form-control" id="m_productDiscount" name="m_productDiscount">
                    </div>

                    <div class="mb-3">
                        <label for="m_qty" class="form-label">QTY</label>
                        <input type="number" class="form-control" id="m_qty" name="m_qty">
                    </div>
                    <div class="mb-3">
                        <label for="m_productMainCategory" class="form-label">Main Category</label>
                        <select class="form-select" name="m_productMainCategory" id="m_productMainCategory"></select>
                    </div>
                    <div class="mb-3">
                        <label for="m_productSubCategory" class="form-label">Sub Category</label>
                        <select class="form-select" name="m_productSubCategory" id="m_productSubCategory"></select>
                    </div>
                    <div class="mb-3">
                        <label for="m_productColor" class="form-label">Color</label>
                        <select class="form-select" name="m_productColor" id="m_productColor"></select>
                    </div>
                    <div class="mb-3">
                        <label for="m_material" class="form-label">Material</label>
                        <select name="m_material" id="m_material" class="form-select"></select>
                    </div>
                    <div class="mb-3">
                        <label for="m_getBarnds" class="form-label">Brand</label>
                        <select name="m_getBarnds" id="m_getBarnds" class="form-select"></select>
                    </div>
                    <div class="mb-3">
                        <label for="m_description" class="form-label">Product Description</label>
                        <textarea class="form-control" name="m_description" id="m_description" cols="3" rows="1" maxlength="500"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3" id="upP">Save changes</button>
                    <div class="mb-3">
                        <label for="formFile1" class="form-label">Image 01</label>
                        <input class="form-control" type="file" id="formFile1">
                        <button class="btn btn-secondary mt-1" id="piUp1" onclick="UpdateImage('1')">Update Image 01</button>
                    </div>
                    <div class="mb-3">
                        <label for="formFile2" class="form-label">Image 02</label>
                        <input class="form-control" type="file" id="formFile2">
                        <button class="btn btn-secondary mt-1" id="piUp2" onclick="UpdateImage('2')">Update Image 02</button>
                    </div>
                    <div class="mb-3">
                        <label for="formFile3" class="form-label">Image 03</label>
                        <input class="form-control" type="file" id="formFile3"> <!-- Corrected the ID here -->
                        <button class="btn btn-secondary mt-1" id="piUp3" onclick="UpdateImage('3')">Update Image 03</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productModal2" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="m_productId2" name="m_productId2">
                    <div class="mb-3">
                        <label for="m_productName2" class="form-label">Name</label>
                        <input type="text" class="form-control" id="m_productName2" maxlength="100" name="m_productName2">
                    </div>
                    <div class="mb-3">
                        <label for="m_productPrice2" class="form-label">Price (Rs.)</label>
                        <input type="number" class="form-control" id="m_productPrice2" name="m_productPrice2">
                    </div>
                    <div class="mb-3">
                        <label for="m_delivery2" class="form-label">Delivery (Rs.)</label>
                        <input type="number" class="form-control" id="m_delivery2" name="m_delivery2">
                    </div>
                    <div class="mb-3">
                        <label for="m_productDiscount2" class="form-label">Discount (%)</label>
                        <input type="number" class="form-control" id="m_productDiscount2" name="m_productDiscount2">
                    </div>
                    <div class="mb-3">
                        <label for="m_qty2" class="form-label">QTY</label>
                        <input type="number" class="form-control" id="m_qty2" name="m_qty2">
                    </div>
                    <div class="mb-3">
                        <label for="m_productMainCategory2" class="form-label">Main Category</label>
                        <select name="m_productMainCategory2" id="m_productMainCategory2" class="form-select"></select>
                    </div>
                    <div class="mb-3">
                        <label for="m_productSubCategory2" class="form-label">Sub Category</label>
                        <select name="m_productSubCategory2" id="m_productSubCategory2" class="form-select"></select>
                    </div>
                    <div class="mb-3">
                        <label for="m_productColor2" class="form-label">Color</label>
                        <select name="m_productColor2" id="m_productColor2" class="form-select"></select>
                    </div>
                    <div class="mb-3">
                        <label for="m_material2" class="form-label">Material</label>
                        <select name="m_material2" id="m_material2" class="form-select"></select>
                    </div>

                    <div class="mb-3">
                        <label for="m_getBarnds2" class="form-label">Barnd</label>
                        <select name="m_getBarnds2" id="m_getBarnds2" class="form-select"></select>
                    </div>
                    <div class="mb-3">
                        <label for="m_description2" class="form-label">Product Description</label>
                        <textarea class="form-control" name="m_description2" id="m_description2" cols="3" rows="1" maxlength="500"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile4" class="form-label">Image 01</label>
                        <input class="form-control" type="file" id="formFile4">
                    </div>

                    <div class="mb-3">
                        <label for="formFile5" class="form-label">Image 02</label>
                        <input class="form-control" type="file" id="formFile5">
                    </div>
                    <div class="mb-3">
                        <label for="formFile6" class="form-label">Image 03</label>
                        <input class="form-control" type="file" id="formFile6">
                    </div>
                    <button type="submit" id="psave" class="btn btn-primary mb-3">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productCategoryModal2" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Manage Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="w-100">
                        <div class="row">
                            <div class="col-12">
                                <h4>Main Categorys</h4>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                        <input type="text" maxlength="45" class="form-control w-75" id="cmInput" onkeyup="getMainCa();" placeholder="Category id or Name">
                                        <button class="btn btn-info" id="mainCAddBtn" onclick="addMainC();" disabled>Add New</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle table-hover" id="productTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody id="categoryMainTbaleBody">
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="w-100">
                        <div class="row">
                            <div class="col-12">
                                <h4>Sub Categorys</h4>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                        <input type="text" maxlength="45" class="form-control w-75" id="suInput" onkeyup="getSubCa();" placeholder="Category id or Name">
                                        <button class="btn btn-info" id="subCAddBtn" onclick="addSubC()" disabled>Add New</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle table-hover" id="productTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody id="categorySuTbaleBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productBrandModal2" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productBrandModal2Label">Manage Brands</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                        <input type="text" maxlength="45" class="form-control w-75" id="brandInput2" onkeyup="getBrand2();" placeholder="Brand id or Name">
                                        <button class="btn btn-info" id="brandAddBtn" onclick="addNewBrand()" disabled>Add New</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle table-hover" id="brandTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody id="brandsTbaleBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>
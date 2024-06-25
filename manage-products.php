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

<body onload="getProduct(); getMainCategories(); getSubCategories();">
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
            <div class="col-md-3">
                <label for="filterCategory">Search</label>
                <input type="search" class="form-control" id="searchField" onkeyup="getProduct();" placeholder="Search products...">
            </div>
            <div class="col-md-3">
                <label for="filterCategory">Main Category</label>
                <select class="form-select" id="filterCategory" onchange="getProduct();">

                </select>
            </div>
            <div class="col-md-3">
                <label for="filterCategory">Sub Category</label>
                <select class="form-select" id="filterSuCategory" onchange="getProduct();">

                </select>
            </div>
            <div class="col-md-2 mt-4">
                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#productModal2">Add Product</button>
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
                        <th>Main Category</th>
                        <th>Sub Category</th>
                        <th>Color</th>
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
                    <form id="editProductForm">
                        <input type="hidden" id="m_productId" name="m_productId">
                        <div class="mb-3">
                            <label for="m_productName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="m_productName" name="m_productName">
                        </div>
                        <div class="mb-3">
                            <label for="m_productPrice" class="form-label">Price (Rs.)</label>
                            <input type="text" class="form-control" id="m_productPrice" name="m_productPrice">
                        </div>
                        <div class="mb-3">
                            <label for="m_productDiscount" class="form-label">Discount (%)</label>
                            <input type="text" class="form-control" id="m_productDiscount" name="m_productDiscount">
                        </div>
                        <div class="mb-3">
                            <label for="m_productMainCategory" class="form-label">Main Category</label>
                            <input type="text" class="form-control" id="m_productMainCategory" name="m_productMainCategory">
                        </div>
                        <div class="mb-3">
                            <label for="m_productSubCategory" class="form-label">Sub Category</label>
                            <input type="text" class="form-control" id="m_productSubCategory" name="m_productSubCategory">
                        </div>
                        <div class="mb-3">
                            <label for="m_productColor" class="form-label">Color</label>
                            <input type="text" class="form-control" id="m_productColor" name="m_productColor">
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">Save changes</button>

                        <div class="mb-3">
                            <div>
                                <input class="form-control" type="file" id="formFile1">
                                <button class="btn btn-primary mt-1">Update Image 01</button>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div>
                                <input class="form-control" type="file" id="formFile2">
                                <button class="btn btn-primary mt-1">Update Image 02</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div>
                                <input class="form-control" type="file" id="formFile3">
                                <button class="btn btn-primary mt-1">Update Image 03</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productModal2" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        <input type="hidden" id="m_productId2" name="m_productId2">
                        <div class="mb-3">
                            <label for="m_productName2" class="form-label">Name</label>
                            <input type="text" class="form-control" id="m_productName2" name="m_productName2">
                        </div>
                        <div class="mb-3">
                            <label for="m_productPrice2" class="form-label">Price (Rs.)</label>
                            <input type="text" class="form-control" id="m_productPrice2" name="m_productPrice2">
                        </div>
                        <div class="mb-3">
                            <label for="m_productDiscount2" class="form-label">Discount (%)</label>
                            <input type="text" class="form-control" id="m_productDiscount2" name="m_productDiscount2">
                        </div>
                        <div class="mb-3">
                            <label for="m_productMainCategory2" class="form-label">Main Category</label>
                            <input type="text" class="form-control" id="m_productMainCategory2" name="m_productMainCategory2">
                        </div>
                        <div class="mb-3">
                            <label for="m_productSubCategory2" class="form-label">Sub Category</label>
                            <input type="text" class="form-control" id="m_productSubCategory2" name="m_productSubCategory2">
                        </div>
                        <div class="mb-3">
                            <label for="m_productColor2" class="form-label">Color</label>
                            <input type="text" class="form-control" id="m_productColor2" name="m_productColor2">
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
                        <button type="submit" class="btn btn-primary mb-3">Save</button>
                    </form>
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
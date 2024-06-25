function showSpinners() {
    document.getElementById("loadingSpin").className = "d-flex justify-content-center align-items-center position-absolute w-100 h-100 spin";
}

function hideSpinners() {
    document.getElementById("loadingSpin").className = "d-none";
}

function showToast(text, cl) {
    document.getElementById("text-body").innerHTML = text;
    document.getElementById("toast-container").className = "toast " + cl;
    const toastElement = new bootstrap.Toast(document.querySelector('.toast'));
    toastElement.show();
}

function hideToast() {
    const toastElement = new bootstrap.Toast(document.querySelector('.toast'));
    toastElement.hide();
}

function Login() {

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    const form = new FormData();
    form.append('username', username);
    form.append('password', password);

    const request = new XMLHttpRequest();

    showSpinners();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            hideSpinners()
            if (request.responseText == "ok") {
                window.location.replace("dashboard.php");
            } else if (request.responseText == "2fa") {
                window.location.replace("verify-code.php");
            } else {
                document.getElementById("text-erro").innerHTML = request.responseText;
                new bootstrap.Modal(document.getElementById("error-model")).show();
            }
        }

    }

    request.open("POST", "user-login-procces.php", true);
    request.send(form);

}

function Logout() {
    const request = new XMLHttpRequest();

    showSpinners();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            hideSpinners();
            window.location.replace("index.php");
        }
    }

    request.open('GET', 'logout.php', true);
    request.send();
}

function verifyLogin() {

    const code = document.getElementById("code").value;

    const form = new FormData();
    form.append('code', code);

    const request = new XMLHttpRequest();

    showSpinners();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            hideSpinners();
            if (request.responseText == "ok") {
                window.location.replace("dashboard.php");
            } else {
                document.getElementById("text-erro").innerHTML = request.responseText;
                new bootstrap.Modal(document.getElementById("error-model")).show();
            }
        }

    }

    request.open("POST", "verify-login.php", true);
    request.send(form);

}

function resendCode() {

    const request = new XMLHttpRequest();

    showSpinners();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            hideSpinners();
            if (request.responseText == "ok") {
                document.getElementById("text-erro").innerHTML = request.responseText;
                new bootstrap.Modal(document.getElementById("error-model")).show();
            }
        }

    }

    request.open("POST", "resend-code-proccess.php", true);
    request.send();

}

// get invoice items

document.addEventListener("DOMContentLoaded", function () {
    const adminTable = document.getElementById("in_item");
    const modal = new bootstrap.Modal(document.getElementById("staticBackdrop"));

    // Event listener for table row double-click
    adminTable.addEventListener("dblclick", function (event) {
        const target = event.target;
        const tr = target.closest("tr");

        if (tr) {
            // Populate modal fields with table row data
            const cells = tr.querySelectorAll("td");
            document.getElementById("in_id").value = cells[0].textContent.trim();
            const idDiv = cells[1].querySelector(".fw-bold");
            const usernameDiv = cells[1].querySelector(".fw-bold");
            document.getElementById("in_username").value = usernameDiv.textContent.trim();
            document.getElementById("in_id").value = idDiv.textContent.trim();
            document.getElementById("in_qty").value = cells[4].textContent.trim();
            document.getElementById("in_grand").value = cells[5].textContent.trim();
            document.getElementById("in_status").value = tr.querySelector("select").value;

            const request = new XMLHttpRequest();

            const formData = new FormData();
            formData.append("id", cells[0].textContent.trim());

            showSpinners();

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    hideSpinners();
                    if (request.responseText) {
                        const items = JSON.parse(request.responseText);
                        populateModalTable(items);
                    }
                }
            };

            request.open("POST", "get-invoice-items.php", true);
            request.send(formData);

            // Show modal
            modal.show();
        }
    });

    // Event listener for mobile touch (simulate double-click)
    let lastTouchTime = 0;
    adminTable.addEventListener("touchend", function (event) {
        const currentTime = new Date().getTime();
        const tapLength = currentTime - lastTouchTime;

        if (tapLength < 500 && tapLength > 0) {
            event.preventDefault();
            const fakeDblClickEvent = new MouseEvent("dblclick", {
                bubbles: true,
                cancelable: true,
                view: window
            });
            event.target.dispatchEvent(fakeDblClickEvent);
        }

        lastTouchTime = currentTime;
    }, false);

    // Function to populate the modal table
    function populateModalTable(items) {
        const modalTableBody = document.getElementById("modalTableBody");
        modalTableBody.innerHTML = ""; // Clear existing rows

        items.forEach(item => {
            const row = `
                <tr>
                    <td>${item.itemId}</td>
                    <td>${item.itemName}</td>
                    <td>${item.itemQty}</td>
                    <td>${item.itemPrice}</td>
                    <td>${item.toatal}</td>
                </tr>
            `;
            modalTableBody.innerHTML += row;
        });
    }
});

// get invoice items

// user data

document.addEventListener("DOMContentLoaded", function () {
    const userTable = document.getElementById("user_table");
    const modal = new bootstrap.Modal(document.getElementById("user_modal"));

    // Event listener for table row double-click
    userTable.addEventListener("dblclick", function (event) {
        const target = event.target;
        const tr = target.closest("tr");

        if (tr) {
            // Populate modal fields with table row data
            const cells = tr.querySelectorAll("td");
            document.getElementById("in_username").value = cells[0].querySelector(".fw-bold").textContent.trim();
            document.getElementById("in_firstname").value = cells[1].textContent.trim();
            document.getElementById("in_lastname").value = cells[2].textContent.trim();
            document.getElementById("in_mobile").value = cells[3].textContent.trim();
            document.getElementById("in_email").value = cells[4].textContent.trim();

            // Set selected status
            const statusValue = tr.querySelector("select").value;
            const statusSelect = document.getElementById("in_status");
            for (let i = 0; i < statusSelect.options.length; i++) {
                if (statusSelect.options[i].value === statusValue) {
                    statusSelect.options[i].selected = true;
                    break;
                }
            }

            const request = new XMLHttpRequest();

            const formData = new FormData();
            formData.append("username", cells[0].querySelector(".fw-bold").textContent.trim());

            showSpinners();

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    hideSpinners();
                    if (request.responseText) {


                        const items = JSON.parse(request.responseText);

                        if (items == "no") {
                            const modalTableBody = document.getElementById("modalTableBody");
                            modalTableBody.innerHTML = ""; // Clear existing rows
                        } else {
                            populateModalTable(items);
                        }
                    }
                }
            };

            request.open("POST", "get-user-address.php", true);
            request.send(formData);

            // Show modal
            modal.show();
        }

    });

    // Event listener for mobile touch (simulate double-click)
    let lastTouchTime = 0;
    userTable.addEventListener("touchend", function (event) {
        const currentTime = new Date().getTime();
        const tapLength = currentTime - lastTouchTime;

        if (tapLength < 500 && tapLength > 0) {
            event.preventDefault();
            const fakeDblClickEvent = new MouseEvent("dblclick", {
                bubbles: true,
                cancelable: true,
                view: window
            });
            event.target.dispatchEvent(fakeDblClickEvent);
        }

        lastTouchTime = currentTime;
    }, false);


    // Function to populate the modal table
    function populateModalTable(items) {
        const modalTableBody = document.getElementById("modalTableBody");
        modalTableBody.innerHTML = ""; // Clear existing rows

        items.forEach(item => {
            const row = `
            <tr>
            <td>${item.address_id}</td>
            <td>${item.address}</td>
            <td>${item.city_name}</td>
            <td>${item.district_name}</td>
            <td>${item.address_mobile}</td>
            </tr>
            `;
            modalTableBody.innerHTML += row;
        });
    }


});


// user data

function search() {

    const id = document.getElementById("searchField").value;

    const request = new XMLHttpRequest();

    const from = new FormData();
    from.append('text', id);

    showSpinners();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            hideSpinners();
        }

    }

    request.open("POST", "set-text.php", true);
    request.send(from);

}

function searchInvoice() {
    const id = document.getElementById("searchField").value;
    const fl = document.getElementById("fl").value;

    const request = new XMLHttpRequest();

    const from = new FormData();
    from.append('id', id);
    from.append('fl', fl);
    document.getElementById("in_table_body").innerHTML = "";
    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            document.getElementById("in_table_body").innerHTML = request.responseText;
        }

    }

    request.open("POST", "get-invoice.php", true);
    request.send(from);
}

function chengInvoiceStatus(id) {

    const st = document.getElementById("get_status").value;

    const request = new XMLHttpRequest();

    const from = new FormData();
    from.append('st', st);
    from.append('id', id);

    showSpinners();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            hideSpinners();
            searchInvoice();
        }

    }

    request.open("POST", "cheng-Invoice-status.php", true);
    request.send(from);

}

function searchUsers() {

    const search = document.getElementById("searchField").value;
    const fl = document.getElementById("get_status").value;

    const request = new XMLHttpRequest();

    const from = new FormData();
    from.append('search', search);
    from.append('fl', fl);

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            document.getElementById("userTableBody").innerHTML = "";
            document.getElementById("userTableBody").innerHTML = request.responseText;
            document.getElementById("us-count").innerHTML = "Users(" + document.getElementById("userTableBody").rows.length + ")";
        }

    }

    request.open("POST", "get-users.php", true);
    request.send(from);

}

function chengUserStatus(username) {

    const st = document.getElementById("get_status1").value;

    const request = new XMLHttpRequest();

    const from = new FormData();
    from.append('st', st);
    from.append('username', username);

    showSpinners();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            hideSpinners();
            searchUsers();
        }

    }

    request.open("POST", "cheng-user-status.php", true);
    request.send(from);
}


function searchAdmins() {
    const search = document.getElementById("searchField").value;
    const fl = document.getElementById("get_status").value;

    const request = new XMLHttpRequest();

    const from = new FormData();
    from.append('search', search);
    from.append('fl', fl);

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            document.getElementById("adminTableBody").innerHTML = "";
            document.getElementById("adminTableBody").innerHTML = request.responseText;
            document.getElementById("us-count").innerHTML = "Admins(" + document.getElementById("userTableBody").rows.length + ")";
        }

    }

    request.open("POST", "get-admin.php", true);
    request.send(from);
}



function chengAdminStatus(username) {
    const st = document.getElementById("get_status1").value;

    const request = new XMLHttpRequest();

    const from = new FormData();
    from.append('st', st);
    from.append('username', username);

    showSpinners();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            hideSpinners();
            window.location.reload();
        }

    }

    request.open("POST", "cheng-admin-status.php", true);
    request.send(from);
}

function addNewAddmin() {

    const email = document.getElementById("new_email");
    const fname = document.getElementById("new_fname");
    const lname = document.getElementById("new_lname");
    const mobile = document.getElementById("new_mobile");
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    const mregex = /^[0]{1}[7]{1}[01245678]{1}[0-9]{7}$/;

    if (email.value == "") {
        showToast('Please enter an Email address!', 'bg-danger-subtle');
    } else if (fname.value == "") {
        showToast('Please enter first name!', 'bg-danger-subtle');
    } else if (lname.value == "") {
        showToast('Please enter last name!', 'bg-danger-subtle');
    } else if (mobile.value == "") {
        showToast('Please enter mobile number!', 'bg-danger-subtle');
    } else if (regex.test(email.value) == false) {
        showToast('Email is invalid!', 'bg-danger-subtle');
    } else if (mregex.test(mobile.value) == false) {
        showToast('Mobile Number is invalid!', 'bg-danger-subtle');
    } else {

        const request = new XMLHttpRequest();

        const from = new FormData();
        from.append('email', email.value);
        from.append('fname', fname.value);
        from.append('lname', lname.value);
        from.append('mobile', mobile.value);

        showSpinners();

        request.onreadystatechange = function () {
            hideSpinners();
            if (request.readyState == "4" && request.status == "200") {

                if (request.responseText == "ok") {
                    bootstrap.Modal.getInstance(document.getElementById("addAdminModle")).hide();
                    searchAdmins();
                } else {
                    showToast(`${request.responseText}`, 'bg-danger-subtle');
                }
            }

        }

        request.open("POST", "add-new-admin.php", true);
        request.send(from);

    }

}

function updateAdmin() {

}

function VerificationCheng(st) {
    if (confirm("Continue?") == true) {
        const request = new XMLHttpRequest();

        const from = new FormData();

        from.append("st", st);

        showSpinners();

        request.onreadystatechange = function () {

            if (request.readyState == "4" && request.status == "200") {

                if (request.responseText == "ok") {
                    window.location.reload();
                } else {
                    hideSpinners();
                    showToast(`${request.responseText}`, 'bg-danger-subtle');
                }
            }

        }

        request.open("POST", "chenge-verification.php", true);
        request.send(from);

    }
}

function DeactivateAccount() {


    if (confirm("Deactivate Account?") == true) {
        const request = new XMLHttpRequest();

        const from = new FormData();

        showSpinners();

        request.onreadystatechange = function () {

            if (request.readyState == "4" && request.status == "200") {

                if (request.responseText == "ok") {
                    window.location.reload();
                } else {
                    hideSpinners();
                    showToast(`${request.responseText}`, 'bg-danger-subtle');
                }
            }

        }

        request.open("POST", "deactivate-account.php", true);
        request.send(from);
    }


}


function ChangePassword() {

    if (confirm("Change Password?") == true) {
        const request = new XMLHttpRequest();

        const from = new FormData();

        from.append("c_passwrod", document.getElementById("currentPassword").value);
        from.append("co_passwrod", document.getElementById("confirmPassword").value);
        from.append("new_passwrod", document.getElementById("newPassword").value);

        showSpinners();

        request.onreadystatechange = function () {

            if (request.readyState == "4" && request.status == "200") {
                if (request.responseText == "ok") {
                    window.location.reload();
                } else {
                    hideSpinners();
                    showToast(`${request.responseText}`, 'bg-danger-subtle');
                }
            }

        }

        request.open("POST", "change-password.php", true);
        request.send(from);
    }

}

function getProduct() {

    const body = document.getElementById("productTbaleBody");
    const searchText = document.getElementById("searchField");
    const subCategory = document.getElementById("filterSuCategory");
    const mainCategory = document.getElementById("filterCategory");

    const request = new XMLHttpRequest();

    body.innerHTML = "";

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            body.innerHTML = request.responseText;
        }

    }

    const url = `get-product.php?search=${searchText.value}&su=${subCategory.value}&mc=${mainCategory.value}`;
    request.open("GET", url, true);
    request.send();

}

function chengStatusProduct(id, st) {

    if (confirm("Chenge Status?") === true) {

        const request = new XMLHttpRequest();

        const from = new FormData();

        from.append("id", id);
        from.append("st", st);

        showSpinners();
        request.onreadystatechange = function () {

            if (request.readyState == "4" && request.status == "200") {
                hideSpinners();
                if (request.responseText == "ok") {
                    getProduct();
                } else {
                    alert(request.responseText);
                }
            }

        }

        request.open("POST", "cheng-product-status.php", true);
        request.send(from);
    }
}


function getMainCategories() {

    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            document.getElementById("filterCategory").innerHTML = request.responseText;
            document.getElementById("m_productMainCategory2").innerHTML = request.responseText;
            document.getElementById("m_productMainCategory").innerHTML = request.responseText;
        }

    }

    request.open("GET", "get-mani-categorues.php", true);
    request.send();
}

function getColors() {
    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200")
            document.getElementById("m_productColor").innerHTML = request.responseText;
        document.getElementById("m_productColor2").innerHTML = request.responseText;
    }
    request.open("GET", "get-colors.php", true);
    request.send();
}

function getMaterial() {
    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200")
            document.getElementById("m_material").innerHTML = request.responseText;
        document.getElementById("m_material2").innerHTML = request.responseText;
    }
    request.open("GET", "get-material.php", true);
    request.send();
}

function getSubCategories() {

    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            document.getElementById("filterSuCategory").innerHTML = request.responseText;
            document.getElementById("m_productSubCategory").innerHTML = request.responseText;
            document.getElementById("m_productSubCategory2").innerHTML = request.responseText;
        }

    }

    request.open("GET", "get-sub-categorues.php", true);
    request.send();
}

function getBrands() {

    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            document.getElementById("m_getBarnds").innerHTML = request.responseText;
            document.getElementById("m_getBarnds2").innerHTML = request.responseText;
        }

    }

    request.open("GET", "get-barnds.php", true);
    request.send();
}


$(document).ready(function () {
    // Double-click event listener on table rows
    $('#productTable tbody').on('dblclick', 'tr', function () {
        // Get data from the clicked row
        var id = $(this).find('td:eq(0)').text(); // ID
        var name = $(this).find('td:eq(1)').text(); // Name
        var price = $(this).find('td:eq(2)').text(); // Price
        var discount = $(this).find('td:eq(3)').text(); // Discount
        var mainCategory = $(this).find('td:eq(4)').text(); // Main Category
        var subCategory = $(this).find('td:eq(5)').text(); // Sub Category
        var color = $(this).find('td:eq(6)').text(); // Color

        // Set values to the modal form fields
        $('#m_productId').val(id);
        $('#m_productName').val(name);
        $('#m_productPrice').val(price);
        $('#m_productDiscount').val(discount);

        // Set the selected option for main category
        $('#m_productMainCategory option').each(function () {
            if ($(this).text() === mainCategory) {
                $(this).prop('selected', true);
            } else {
                $(this).prop('selected', false);
            }
        });

        // Set the selected option for sub category
        $('#m_productSubCategory option').each(function () {
            if ($(this).text() === subCategory) {
                $(this).prop('selected', true);
            } else {
                $(this).prop('selected', false);
            }
        });

        // Set the selected option for color
        $('#m_productColor option').each(function () {
            if ($(this).text() === color) {
                $(this).prop('selected', true);
            } else {
                $(this).prop('selected', false);
            }
        });

        // Show the modal
        $('#productModal').modal('show');
    });
});

$(document).ready(function () {
    // Save button event handler
    $('#psave').on('click', function (event) {
        // Prevent any default behavior
        event.preventDefault();

        var name = $('#m_productName2').val().trim(); // Name
        var price = $('#m_productPrice2').val().trim(); // Price
        var discount = $('#m_productDiscount2').val().trim(); // Discount
        var mainCategory = $('#m_productMainCategory2').val(); // Main Category
        var subCategory = $('#m_productSubCategory2').val(); // Sub Category
        var color = $('#m_productColor2').val(); // Color
        var itemQty = $('#m_qty2').val();
        var description = $('#m_qty2').val();
        var material = $('#m_material2').val();
        var delivery = $('#m_delivery2').val();
        var barnds = $('#m_getBarnds2').val();


        var image1 = $('#formFile4')[0].files[0]; // Image 01 file object
        var image2 = $('#formFile5')[0].files[0]; // Image 02 file object
        var image3 = $('#formFile6')[0].files[0]; // Image 03 file object

        // Basic validation
        var isValid = true;
        var errorMessage = '';

        if (name === '') {
            isValid = false;
            errorMessage += 'Name is required.\n';
        }
        if (price === '' || isNaN(price) || price <= 0) {
            isValid = false;
            errorMessage += 'Valid price is required.\n';
        }
        if (delivery === '' || isNaN(delivery) || delivery <= 0) {
            isValid = false;
            errorMessage += 'Valid delivery price is required.\n';
        }
        if (discount === '' || isNaN(discount) || discount < 0 || discount > 100) {
            isValid = false;
            errorMessage += 'Valid discount percentage is required (0-100).\n';
        }
        if (itemQty === '' || isNaN(itemQty) || itemQty < 0) {
            isValid = false;
            errorMessage += 'Valid item Qty is required.\n';
        }
        if (mainCategory === '') {
            isValid = false;
            errorMessage += 'Main Category is required.\n';
        }
        if (subCategory === '') {
            isValid = false;
            errorMessage += 'Sub Category is required.\n';
        }
        if (material === '') {
            isValid = false;
            errorMessage += ('Material is required.\n');
        }
        if (color === '') {
            isValid = false;
            errorMessage += 'Color is required.\n';
        }
        if (barnds === '') {
            isValid = false;
            errorMessage += 'Brand is required.\n';
        }
        if (description === '') {
            isValid = false;
            errorMessage += 'Sub Description is required.\n';
        }
        if (!image1) {
            isValid = false;
            errorMessage += 'Image 01 is required.\n';
        }
        if (!image2) {
            isValid = false;
            errorMessage += 'Image 02 is required.\n';
        }
        if (!image3) {
            isValid = false;
            errorMessage += 'Image 03 is required.\n';
        }

        // Check validation
        if (!isValid) {
            // Display error message(s)
            alert(errorMessage);
            return;
        }

        // If valid, prepare form data for AJAX submission
        var formData = new FormData();
        formData.append('name', name);
        formData.append('price', price);
        formData.append('discount', discount);
        formData.append('mainCategory', mainCategory);
        formData.append('subCategory', subCategory);
        formData.append('color', color);
        formData.append('image1', image1);
        formData.append('image2', image2);
        formData.append('image3', image3);
        formData.append('qty', itemQty);
        formData.append('description', description);
        formData.append('material', material);
        formData.append('delivery', delivery);
        formData.append('barnd', barnds);

        // Perform AJAX request
        $.ajax({
            url: 'http://localhost/MyShop/add-new-product.php', // Replace with your server URL
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Handle success response
                if (response === "ok") {
                    $('#productModal2').modal('hide');
                    alert('Product added successfully!');
                    // Optionally reload or update the product list
                    getProduct(); // Example function to refresh product list
                } else {
                    alert('Failed to add product: ' + response);
                }
            },
            error: function (error) {
                // Handle error response
                console.log('Error:', error);
                alert('Error adding product. Please try again.');
            }
        });
    });
});









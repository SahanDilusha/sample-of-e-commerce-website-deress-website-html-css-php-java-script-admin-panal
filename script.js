function showSpinners() {
    document.getElementById("loadingSpin").className = "d-flex justify-content-center align-items-center position-absolute w-100 h-100 spin";
}

function hideSpinners() {
    document.getElementById("loadingSpin").className = "d-none";
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
    window.location.href = "http://localhost/myshop-admin/orders.php?id=" + document.getElementById("searchField").value;
}

function filterInvoice() {
    window.location.href = "http://localhost/myshop-admin/orders.php?fl=" + document.getElementById("fl").value;

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
            alert(request.responseText);
            hideSpinners();
            window.location.reload();
        }

    }

    request.open("POST", "cheng-Invoice-status.php", true);
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
            alert(request.responseText);
            hideSpinners();
            window.location.reload();
        }

    }

    request.open("POST", "cheng-user-status.php", true);
    request.send(from);
}

function searchUsers() {
    window.location.href="http://localhost/myshop-admin/users.php?search=" + document.getElementById("searchField").value;
}

function flUsers() {
    window.location.href="http://localhost/myshop-admin/users.php?fl=" + document.getElementById("get_status").value;
}

function searchAdmins() {
    window.location.href="http://localhost/myshop-admin/admins.php?search=" + document.getElementById("searchField").value;
}

function flAdmin() {
    window.location.href="http://localhost/myshop-admin/admins.php?fl=" + document.getElementById("get_status").value;
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
            alert(request.responseText);
            hideSpinners();
            window.location.reload();
        }

    }

    request.open("POST", "cheng-admin-status.php", true);
    request.send(from);
}

function addNewAddmin() {
    


}
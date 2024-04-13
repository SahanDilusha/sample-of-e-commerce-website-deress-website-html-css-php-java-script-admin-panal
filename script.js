function Login() {

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
 
    const form = new FormData();
    form.append('username', username);
    form.append('password', password);

   

    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            if (request.responseText !== "ok") {
                document.getElementById("text-erro").innerHTML = request.responseText;
                new bootstrap.Modal(document.getElementById("error-model")).show();
            } else {
                window.location.replace("dashboard.php");
            }
        }

    }

    request.open("POST", "user-login-procces.php", true);
    request.send(form);

}


function Logout() {
    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {

            window.location.href = "index.php";
        }
    }

    request.open('GET', 'logout.php', true);
    request.send();
}
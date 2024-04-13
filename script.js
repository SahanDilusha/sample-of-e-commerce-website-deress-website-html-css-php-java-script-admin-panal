function Login() {

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
 
    const form = new FormData();
    form.append('username', username);
    form.append('password', password);

    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            if (request.responseText == "ok") {
                window.location.replace("dashboard.php");
            } else if (request.responseText == "2fa") {
                window.location.replace("verify-code.php.php");
            } else{
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

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {

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

    request.onreadystatechange = function () {

        if (request.readyState == "4" && request.status == "200") {
            alert(request.responseText);
            if (request.responseText == "ok") {
                window.location.replace("dashboard.php");
            } else{
                document.getElementById("text-erro").innerHTML = request.responseText;
                new bootstrap.Modal(document.getElementById("error-model")).show();
            }
        }

    }

    request.open("POST", "verify-code.php", true);
    request.send(form);

}


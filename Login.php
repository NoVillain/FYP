<?php

include('../Database.php');

if (isset($_POST['submit'])) {
    $id = $_POST['nAdminID'];
    $pw = $_POST['nAdminPW'];

    //Sql admin
    $sqlAdmin = "SELECT * FROM admin WHERE adminID= '$id' AND adminPW = '$pw'";

    //Check if exist admin
    $result = $conn->query($sqlAdmin);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //Set cookies
            $adminName = $row['adminName'];
            //24 hours
            setcookie("loginAdmin", "$adminName", time() + 1 * 24 * 60 * 60);

            //Login success
            //header("Location: AdminMenu.html");

            echo "
                <script type=\"text/javascript\"> 
                    function send() { 
                        var s = document.getElementById('submit');
                        s.click();

                        //window.location.assign(\"AdminMenu.html\");
                    }

                    window.onload = send;
                </script>

                <form id=\"fsubmit\" name=\"fsubmit\" value=\"fsubmit\" method=\"POST\" action=\"AdminMenu.html\"> 
                    <input type=\"submit\" name=\"submit\" id=\"submit\" />
                </form>                
            ";
        }
    } else {
        header("Location: LoginFail.html");
    }
} else {
    echo "Not submited";
}

$conn->close();

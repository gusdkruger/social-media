<?php
    include "../../connection/connection.php";

    if(isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $conn = createConnection();
        $stmt = $conn -> prepare("SELECT password FROM user WHERE email='$email';");
        $stmt -> execute();
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($result) {
            $passwordHash = $result["password"];
            if(password_verify($password, $passwordHash)) {
                echo "Loged successfully";
            }
            else {
                echo "Email not registred or incorrect password";
            }
        }
        else {
            echo "Email not registred or incorrect password";
        }
        $conn = null;
    }
?>
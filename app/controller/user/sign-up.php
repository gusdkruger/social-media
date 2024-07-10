<?php
    include "../../connection/connection.php";

    if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password-repeat"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if($password === $_POST["password-repeat"]) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user VALUES (0, '$email', '$passwordHash');";
            $conn = createConnection();
            try {
                $conn -> exec($sql);
                echo "User created successfully";
            }
            catch (PDOException $e) {
                echo $e;
            }
        }
        else {
            echo "Passwords dont match";
        }
        $conn = null;
    }
?>
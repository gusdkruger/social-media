<?php
    include __DIR__ . "/../../model/userModel.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            // VALIDATE DATA
            UserModel::login($email, $password);
            header("Location: ../../../index.php");
            exit();
        }
    }
?>

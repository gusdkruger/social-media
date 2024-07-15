<?php
    include __DIR__ . "/../../model/userModel.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["handle"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password-repeat"])) {
            $handle = $_POST["handle"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            // VALIDATE DATA
            if($password === $_POST["password-repeat"]) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                UserModel::register($handle, $email, $passwordHash);
            }
            else {
                echo "Passwords dont match";
            }
        }
    }
?>

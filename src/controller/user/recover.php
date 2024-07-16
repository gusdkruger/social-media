<?php
    include __DIR__ . "/../../model/userModel.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["handle"]) && isset($_POST["email"])) {
            $handle = $_POST["handle"];
            $email = $_POST["email"];
            // VALIDATE DATA
            echo "Not implemented yet <br> <a href='../../../index.php'>Return</a>";
        }
    }
?>

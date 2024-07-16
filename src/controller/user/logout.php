<?php
    include __DIR__ . "/../../session/session.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["logged"] = false;
        header("Location: ../../../index.php");
        exit();
    }
?>

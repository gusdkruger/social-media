<?php
    include __DIR__ . "/../session/session.php";

    function loadHeader() {
        return "\n";
    }

    function loadMain() {
        if($_SESSION["logged"]) {
            readfile(__DIR__ . "/html/feed.html");
        }
        else {
            readfile(__DIR__ . "/html/login.html");
        }
    }

    function loadFooter() {
        return "\n";
    }
?>

<?php
    function loadHeader() {
        return "\n";
    }

    function loadMain() {
        // IF LOGGED
        // LOAD FEED
        // ELSE
        readfile(__DIR__ . "/html/login.html");
    }

    function loadFooter() {
        return "\n";
    }
?>

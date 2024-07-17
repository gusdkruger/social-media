<?php
    include __DIR__ . "/../session/session.php";

    class View {

        public static function loadHeader() {
            if($_SESSION["logged"]) {
                readfile(__DIR__ . "/html/header.html");
            }
            else {
                return "\n";
            }
        }

        public static function loadMain() {
            if($_SESSION["logged"]) {
                readfile(__DIR__ . "/html/feed.html");
            }
            else {
                readfile(__DIR__ . "/html/login.html");
            }
        }

        public static function loadFooter() {
            return "\n";
        }
    }
?>

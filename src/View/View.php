<?php

class View {

    public static function loadHtml(): void {
        require_once __DIR__ . "/../Session/Session.php";
        readfile(__DIR__ . "/../../public/html/start.html");
        if($_SESSION["logged"]) {
            View::readTeamplateHeader();
            View::readTeamplateFeed();
        }
        else {
            View::readTeamplateLogin();
        }
        readfile(__DIR__ . "/../../public/html/end.html");
    }

    public static function readTeamplateLogin(): void {
        readfile(__DIR__ . "/../../public/html/login.html");
    }

    public static function readTeamplateSignup(): void {
        readfile(__DIR__ . "/../../public/html/signup.html");
    }

    public static function readTeamplateHeader(): void {
        readfile(__DIR__ . "/../../public/html/header.html");
    }

    public static function readTeamplateFeed(): void {
        readfile(__DIR__ . "/../../public/html/feed.html");
    }
}

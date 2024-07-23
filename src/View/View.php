<?php

class View {

    public static function loadHeader() {
        if($_SESSION["logged"]) {
            View::readTeamplateHeader();
        }
    }

    public static function loadMain() {
        if($_SESSION["logged"]) {
            View::readTeamplateFeed();
        }
        else {
            View::readTeamplateLogin();
        }
    }

    public static function loadFooter() {

    }

    public static function loadHtml() {
        require_once __DIR__ . "/../Session/Session.php";
        new Session();
        readfile(__DIR__ . "/../../public/html/start.html");
        View::loadHeader();
        View::loadMain();
        View::loadFooter();
        readfile(__DIR__ . "/../../public/html/end.html");
    }

    public static function readTeamplateLogin() {
        readfile(__DIR__ . "/../../public/html/login.html");
    }

    public static function readTeamplateSignup() {
        readfile(__DIR__ . "/../../public/html/signup.html");
    }

    public static function readTeamplateHeader() {
        readfile(__DIR__ . "/../../public/html/header.html");
    }

    public static function readTeamplateFeed() {
        readfile(__DIR__ . "/../../public/html/feed.html");
    }
}

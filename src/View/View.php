<?php

namespace Wither\View;

use Wither\Session\Session;

class View {

    public static function loadHtml(): void {
        new Session();
        readfile(__DIR__ . "/../../public/html/start.html");
        if($_SESSION["logged"]) {
            View::readTemplateHeader();
            View::readTemplateFeed();
        }
        else {
            View::readTemplateLogin();
        }
        readfile(__DIR__ . "/../../public/html/end.html");
    }

    public static function readTemplateLogin(): void {
        readfile(__DIR__ . "/../../public/html/login.html");
    }

    public static function readTemplateSignup(): void {
        readfile(__DIR__ . "/../../public/html/signup.html");
    }

    public static function readTemplateHeader(): void {
        readfile(__DIR__ . "/../../public/html/header.html");
    }

    public static function readTemplateFeed(): void {
        readfile(__DIR__ . "/../../public/html/feed.html");
    }
}

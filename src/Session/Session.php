<?php

namespace Wither\Session;

class Session {

    function __construct() {
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
            if(!isset($_SESSION["logged"])) {
                $_SESSION["logged"] = false;
            }
        }
    }
}

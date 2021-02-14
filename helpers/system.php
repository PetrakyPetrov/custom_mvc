<?php

function error_handler($errno, $errstr, $errfile, $errline) {
    echo "<b>Custom error:</b> [$errno] $errstr<br>";
    echo " Error on line $errline in $errfile<br>";
}

function exception_handler($exception) {
    echo "Uncaught exception: " , $exception->getMessage(), "\n";
}

function get_logged_user() {
    if (isset($_SESSION['logged_user'])) {
        return $_SESSION['logged_user'];
    }
    return [];
}

function clear_session() {
    $_SESSION = [];
    $_SESSION['logged_user'] = [];
}

function pass_hash($pass) : string {
    return password_hash($pass, PASSWORD_DEFAULT);
}

function pass_verify($pass, $hash) {
    return password_verify($pass, $hash);
}

set_error_handler("error_handler");
set_exception_handler('exception_handler');
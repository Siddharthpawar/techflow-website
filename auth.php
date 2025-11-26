<?php

session_start();

$ADMIN_USER = 'admin';
$ADMIN_PASS = 'adminpass'; // default password

function is_logged_in() {
    return !empty($_SESSION['is_admin']);
}

function require_admin() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function check_credentials($user, $pass) {
    global $ADMIN_USER, $ADMIN_PASS;
    return ($user === $ADMIN_USER && $pass === $ADMIN_PASS);
}

?>

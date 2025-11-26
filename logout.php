<?php
require_once 'auth.php';
// clear session and redirect to login
session_unset();
session_destroy();
header('Location: login.php');
exit;

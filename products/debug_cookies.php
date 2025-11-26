<?php
require_once '../includes/cookie_helper.php';
header('Content-Type: text/plain');

echo "\$_COOKIE:\n";
print_r($_COOKIE);

echo "\nget_recent_products():\n";
print_r(get_recent_products());

echo "\nget_popular_products():\n";
print_r(get_popular_products());

echo "\nNote: visit a product view (e.g., /products/view.php?id=mobile-dev) first to set cookies.\n";
?>
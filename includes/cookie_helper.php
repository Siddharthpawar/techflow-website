<?php
// Cookie constants
define('RECENT_COOKIE', 'recent_products');
define('POPULAR_COOKIE', 'popular_products');
define('COOKIE_LIFE', 60 * 60 * 24 * 30); // 30 days

/**
 * Track a product view in both recent and popular cookies
 */
function track_product_view($product_id) {
    // Update recently viewed
    $recent = get_recent_products();
    if (($key = array_search($product_id, $recent)) !== false) {
        unset($recent[$key]);
    }
    array_unshift($recent, $product_id);
    $recent = array_slice($recent, 0, 5); // Keep last 5
    setcookie(RECENT_COOKIE, json_encode($recent), time() + COOKIE_LIFE, '/');

    // Update most popular
    $popular = get_popular_products();
    if (!isset($popular[$product_id])) {
        $popular[$product_id] = 0;
    }
    $popular[$product_id]++;
    arsort($popular);
    $popular = array_slice($popular, 0, 5, true); // Keep top 5 visited
    setcookie(POPULAR_COOKIE, json_encode($popular), time() + COOKIE_LIFE, '/');
}

/**
 * Get recently viewed products
 */
function get_recent_products() {
    if (!isset($_COOKIE[RECENT_COOKIE])) {
        return array();
    }
    return json_decode($_COOKIE[RECENT_COOKIE], true) ?: array();
}

/**
 * Get most popular products
 */
function get_popular_products() {
    if (!isset($_COOKIE[POPULAR_COOKIE])) {
        return array();
    }
    return json_decode($_COOKIE[POPULAR_COOKIE], true) ?: array();
}
?>
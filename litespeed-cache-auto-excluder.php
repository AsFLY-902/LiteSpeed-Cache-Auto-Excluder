<?php
/**
 * Plugin Name: LiteSpeed Cache Auto Excluder
 * Description: Adds LiteSpeed Cache exclusions for query strings and cookies on activation.
 * Version: 1.0
 * Author: Ashok Patel [LiteSpeed Technologies]
 * Author URI: https://www.litespeedtech.com/
 */

register_activation_hook(__FILE__, 'add_litespeed_cache_exclusions');

function add_litespeed_cache_exclusions() {
    $messages = [];

    // --- Do Not Cache Query Strings ---
    $qs_option = 'litespeed.conf.cache-exc_qs';
    $qs_to_add = 'accessibility';

    $qs_existing = get_option($qs_option, []);
    $qs_existing = is_string($qs_existing) ? json_decode($qs_existing, true) : $qs_existing;
    if (!is_array($qs_existing)) $qs_existing = [];

    if (!in_array($qs_to_add, $qs_existing)) {
        $qs_existing[] = $qs_to_add;
        update_option($qs_option, json_encode($qs_existing));
        $messages[] = "Added query string exclusion: <code>$qs_to_add</code>";
    } else {
        $messages[] = "Query string <code>$qs_to_add</code> already exists.";
    }

    // --- Do Not Cache Cookies ---
    $cookie_option = 'litespeed.conf.cache-exc_cookies';
    $cookie_to_add = 'wp_accessibility';

    $cookie_existing = get_option($cookie_option, []);
    $cookie_existing = is_string($cookie_existing) ? json_decode($cookie_existing, true) : $cookie_existing;
    if (!is_array($cookie_existing)) $cookie_existing = [];

    if (!in_array($cookie_to_add, $cookie_existing)) {
        $cookie_existing[] = $cookie_to_add;
        update_option($cookie_option, json_encode($cookie_existing));
        $messages[] = "Added cookie exclusion: <code>$cookie_to_add</code>";
    } else {
        $messages[] = "Cookie <code>$cookie_to_add</code> already exists.";
    }

    // Store message to show on next admin load
    update_option('lscache_exclude_notice', $messages);
}

add_action('admin_notices', 'show_litespeed_exclude_notice');

// show admin notice
function show_litespeed_exclude_notice() {
    if ($messages = get_option('lscache_exclude_notice')) {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p><strong>LiteSpeed Cache Auto Excluder:</strong></p><ul>';
        foreach ($messages as $msg) {
            echo "<li>$msg</li>";
        }
        echo '</ul></div>';
        delete_option('lscache_exclude_notice'); // Clean up after showing
    }
}

<?php
// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

class JRVT_Maintenance_Mode {

    /**
     * Initializes the maintenance mode check.
     */
    public static function init() {
        // Use a high priority (like 9) to run early, but not too early
        add_action('template_redirect', [__CLASS__, 'check_maintenance_mode'], 9);
    }

    /**
     * Checks if maintenance mode should be displayed.
     * This is the core function of the plugin.
     */
    public static function check_maintenance_mode() {
        // 1. Get our saved settings
        $options = get_option('mmp_settings');
        $is_enabled = isset($options['status']) && $options['status'] === 'on';

        // 2. If the setting is not enabled, do nothing and exit the function.
        if (!$is_enabled) {
            return;
        }

        // 3. Allow logged-in users with administrative privileges to access the site.
        // `current_user_can('manage_options')` is a good check for this.
        if (current_user_can('manage_options')) {
            return;
        }
        
        // 4. If we reach this point, the user is a regular visitor and maintenance mode is on.
        // We stop everything and display a maintenance page.
        
        // Set a 503 Service Unavailable header. This is important for SEO.
        $protocol = wp_get_server_protocol();
        header("$protocol 503 Service Unavailable", true, 503);
        header('Content-Type: text/html; charset=utf-8');
        header('Retry-After: 3600'); // Tell search engines to check back in 1 hour

        // Use wp_die() to display a simple message. We will replace this with a template later.
        wp_die(
            '<div style="text-align: center; font-family: sans-serif; margin-top: 10%;"><h1>Site Under Maintenance</h1><p>Our site is currently undergoing scheduled maintenance. Please check back soon.</p></div>',
            'Under Maintenance',
            ['response' => 503]
        );
    }
}
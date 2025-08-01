<?php
/**
 * Plugin Name: Maintenance Mode Plus
 * Plugin URI: https://jrvt.co.za/plugins/maintenance-mode-plus
 * Description: Replaces the default WP maintenance page with a beautiful, customizable "Coming Soon" or "Under Maintenance" screen.
 * Version: 0.2.0
 * Author: Johnathan Van Tonder (JRVT Pty Ltd)
 * Author URI: https://jrvt.co.za/
 * Developer: Johnathan Van Tonder
 * Developer URI: https://jrvt.co.za/
 * Text Domain: maintenance-mode-plus
 * Domain Path: /languages
 *
 * Requires at least: 6.0
 * Tested up to: 6.5
 * Requires PHP: 7.4
 *
 * WC requires at least: 8.0
 * WC tested up to: 8.3
 *
 * License: Commercial / GPLv3
 * License URI: https://jrvt.co.za/plugin-license
 */

if (!defined('ABSPATH')) {
    exit;
}

// Load the class that adds the admin settings page
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . 'admin/class-admin-page.php';
    new JRVT_Admin_Page();
}

// Load the class that handles the core maintenance mode logic
require_once plugin_dir_path(__FILE__) . 'includes/class-maintenance-mode.php';
JRVT_Maintenance_Mode::init();
<?php
class JRVT_Admin_Page {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_menu']);
    }

    public function add_menu() {
        add_menu_page(
            'Maintenance Plus Settings',      // Page Title
            'Maintenance Plus',               // Menu Title
            'manage_options',                 // Capability
            'maintenance-mode-plus-settings', // Menu Slug
            [$this, 'settings_page_html'],    // Callback
            'dashicons-hourglass'             // Icon
        );
    }

    public function settings_page_html() {
        // We will use the settings template file
        require_once plugin_dir_path(__FILE__) . '../templates/settings-page.php';
    }
}
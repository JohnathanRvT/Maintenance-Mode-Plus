<?php
class JRVT_Admin_Page {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_menu']);
        // Hook into admin_init to register our settings
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_menu() {
        add_menu_page(
            'Maintenance Plus Settings',
            'Maintenance Plus',
            'manage_options',
            'maintenance-mode-plus-settings',
            [$this, 'settings_page_html'],
            'dashicons-hourglass'
        );
    }

    /**
     * Registers the settings, sections, and fields for the admin page.
     */
    public function register_settings() {
        // 1. Register a setting group.
        // This creates a single entry in the wp_options table named 'mmp_settings'.
        register_setting('mmp_settings_group', 'mmp_settings');

        // 2. Add a settings section.
        // This is a visual container for our fields.
        add_settings_section(
            'mmp_status_section',             // Section ID
            'General Settings',               // Section Title
            null,                             // Optional callback function for a description
            'maintenance-mode-plus-settings'  // Page slug to display on
        );

        // 3. Add a settings field.
        // This is the actual UI element.
        add_settings_field(
            'mmp_status',                     // Field ID
            'Enable Maintenance Mode',        // Field Title
            [$this, 'render_status_field'],   // Callback function to render the HTML
            'maintenance-mode-plus-settings', // Page slug
            'mmp_status_section'              // Section ID to display in
        );
    }

    /**
     * Renders the HTML for the 'Enable Maintenance Mode' checkbox.
     */
    public function render_status_field() {
        // Get the entire array of our saved settings
        $options = get_option('mmp_settings');
        // Check if our specific 'status' key is set
        $status = isset($options['status']) ? $options['status'] : '';
        ?>
        <input type='checkbox' name='mmp_settings[status]' <?php checked($status, 'on', true); ?> value='on'>
        <label for='mmp_settings[status]'>When checked, the maintenance page will be shown to non-logged-in users.</label>
        <?php
    }

    public function settings_page_html() {
        // Use the template file for the settings page HTML
        require_once plugin_dir_path(__FILE__) . '../templates/settings-page.php';
    }
}
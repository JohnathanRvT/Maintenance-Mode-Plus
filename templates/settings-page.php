<div class="wrap">
    <h1>Maintenance Mode Plus Settings</h1>
    
    <form method="post" action="options.php">
        <?php
        // Renders the necessary security fields (nonce, action, etc.)
        settings_fields('mmp_settings_group');
        
        // Renders the settings sections and their fields
        do_settings_sections('maintenance-mode-plus-settings');
        
        // Renders the default "Save Changes" button
        submit_button();
        ?>
    </form>
</div>
<?php 

// Add a menu item in the admin dashboard
function ai_art_settings_menu() {
    add_menu_page(
        'AI Art Settings',
        'AI Art Settings',
        'manage_options',
        'ai-art-settings',
        'ai_art_settings_page',
        'dashicons-admin-generic',
        25
    );
}
add_action('admin_menu', 'ai_art_settings_menu');

// Callback function to display the admin page
function ai_art_settings_page() {
    
    include AFB_ART_GEN_PATH."/admin/afb-ai-art-settings.php";
}



// Initialize plugin settings
function ai_art_settings_init() {
    register_setting('ai_art_settings_group', 'afb_ai_art_api_key');
    register_setting('ai_art_settings_group', 'afb_ai_art_prompt');
    register_setting('ai_art_settings_group', 'afb_ai_art_default_product_img');
	register_setting('ai_art_settings_group', 'afb_ai_art_default_watermark_img');
    register_setting('ai_art_settings_group', 'afb_ai_art_style');
    register_setting('ai_art_settings_group', 'afb_ai_art_layout');
    register_setting('ai_art_settings_group', 'afb_ai_art_amount');
    register_setting('ai_art_settings_group', 'afb_ai_art_price');
    register_setting("ai_art_settings_group","afb_ai_art_product_category");
}
add_action('admin_init', 'ai_art_settings_init');

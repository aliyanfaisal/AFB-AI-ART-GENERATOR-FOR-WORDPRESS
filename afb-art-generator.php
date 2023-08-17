<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://aliyanfaisal.urbansofts.com
 * @since             1.0.0
 * @package           Afb_Art_Generator
 *
 * @wordpress-plugin
 * Plugin Name:       Art Generator
 * Plugin URI:        https://https://aliyanfaisal.urbansofts.com
 * Description:       This plugin can convert your images into AI ART. Use shortcode [afb_art_generator]. Built with &hearts; by Aliyan Faisal.
 * Version:           1.0.0
 * Author:            Aliyan Faisal
 * Author URI:        https://https://aliyanfaisal.urbansofts.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       afb-art-generator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('AFB_ART_GENERATOR_VERSION', '1.0.0');
define("AFB_ART_GEN_PATH", plugin_dir_path(__FILE__));

$afb_ai_art_watermark= esc_attr(get_option('afb_ai_art_default_watermark_img'));

if($afb_ai_art_watermark){
	define("AFB_ART_GEN_WATERFALL", wp_get_attachment_url($afb_ai_art_watermark) );
}
else{
	define("AFB_ART_GEN_WATERFALL", plugin_dir_url(__FILE__) . "/watermark.png");
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-afb-art-generator-activator.php
 */

require_once('vendor/autoload.php');
require_once("includes/afb_ai_art_functions.php");

// define("NUERAL_API_KEY","v1.a5dbe6a72fd885d666ca4387b43765609d4070700f58f3272a297d746adcba66");
// define("NUERAL_API_KEY","v1.206040c71b0e8635c43952297952cdcbe465b65653d0e1b5d3a9960cc91503b6");

// define("NUERAL_API_KEY","v1.d05705f51956b2a31cb1551f256a4f2e3ede162e5a589e954b3dc6b345bbe4c6");

$api_key= get_option("afb_ai_art_api_key");
if($api_key){
	define("NUERAL_API_KEY",$api_key);
}
else{
	define("NUERAL_API_KEY","v1.ef90ed7be8df7432fb2b56c2f75ce1ab31ab9e33e404d2c97a0816b2c0ce4035");
}


// define("NUERAL_API_KEY", "v1.bb35625210e2cd418c9cacfe9ea6d5519cc3f62cd5687007f6383eb81576bfca");
function activate_afb_art_generator()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-afb-art-generator-activator.php';
	Afb_Art_Generator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-afb-art-generator-deactivator.php
 */
function deactivate_afb_art_generator()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-afb-art-generator-deactivator.php';
	Afb_Art_Generator_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_afb_art_generator');
register_deactivation_hook(__FILE__, 'deactivate_afb_art_generator');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-afb-art-generator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_afb_art_generator()
{

	$plugin = new Afb_Art_Generator();
	$plugin->run();

}
run_afb_art_generator();

add_action("admin_init", function () {
	if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		// Yes, WooCommerce is enabled
	} else {
		// WooCommerce is NOT enabled!
		add_action('admin_notices', 'woocommerce_not_active_admin_notice');
		deactivate_plugins(plugin_basename(__FILE__));
	}

});

function woocommerce_not_active_admin_notice()
{
	echo '<div class="notice notice-error"><p>AI ART Generator plugin requires WooCommerce to be active. Please activate WooCommerce first.</p></div>';
}



// Redirect to cart when hitting the add-to-cart URL
function redirect_to_cart_if_add_to_cart_url() {
    if (isset($_GET['add-to-cart']) && is_numeric($_GET['add-to-cart'])) {
        wp_safe_redirect(wc_get_cart_url());
        exit;
    }
}
add_action('template_redirect', 'redirect_to_cart_if_add_to_cart_url');



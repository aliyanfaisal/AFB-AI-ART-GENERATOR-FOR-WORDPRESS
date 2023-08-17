<?php

/**
 * Fired during plugin activation
 *
 * @link       https://https://aliyanfaisal.urbansofts.com
 * @since      1.0.0
 *
 * @package    Afb_Art_Generator
 * @subpackage Afb_Art_Generator/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Afb_Art_Generator
 * @subpackage Afb_Art_Generator/includes
 * @author     Aliyan Faisal <aliyanfaisal15@gmail.com>
 */
class Afb_Art_Generator_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		//update options
		$afb_ai_art_price = get_option('afb_ai_art_price');

		if ($afb_ai_art_price === false) {
			update_option('afb_ai_art_price', 10);
		}

		$afb_ai_art_prompt = get_option('afb_ai_art_prompt');

		if ($afb_ai_art_prompt === false) {
			update_option('afb_ai_art_prompt', "");
		}

		$afb_ai_art_style = get_option('afb_ai_art_style');

		if ($afb_ai_art_style === false) {
			update_option('afb_ai_art_style', "PAINTING");
		}

		$afb_ai_art_layout = get_option('afb_ai_art_layout');

		if ($afb_ai_art_layout === false) {
			update_option('afb_ai_art_layout', "SQUARE");
		}

		$afb_ai_art_amount = get_option('afb_ai_art_amount');

		if ($afb_ai_art_amount === false) {
			update_option('afb_ai_art_amount', 1);
		}

		
	}

}

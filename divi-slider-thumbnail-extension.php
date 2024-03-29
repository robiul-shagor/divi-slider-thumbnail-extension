<?php
/*
Plugin Name: Divi Slider Thumbnail Extension
Plugin URI:  
Description: This slider extension for divi
Version:     1.0.0
Author:      Robiul Shagor
Author URI:  https://themeforest.net/user/softhopper
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dste-divi-slider-thumbnail-extension
Domain Path: /languages

Divi Slider Thumbnail Extension is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Divi Slider Thumbnail Extension is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Divi Slider Thumbnail Extension. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

define( 'DIVI_SLIDER_PATH', plugin_dir_path( __DIR__ ) );

if ( ! function_exists( 'rsdbext_initialize_extension' ) ):
	
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function rsdbext_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/DiviSliderThumbnailExtension.php';
}
add_action( 'divi_extensions_init', 'rsdbext_initialize_extension' );
endif;

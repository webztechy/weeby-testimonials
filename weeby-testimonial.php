<?php
/**
 * Plugin Name:     Weeby Testimonial
 * Plugin URI:      https://weeby-testimonial.000webhostapp.com
 * Description:     A WPBakery Page Builder (formerly Visual Composer) testimonial addons with 9 different styles and layout to choose from. Post-type testimonial added to manage testimony details.
 * Author:          WeeBY
 * Author URI:      http://weeby-it.com
 * Text Domain:     weeby-testimonial
 * Domain Path:     /languages
 * Version:         0.2.0
 *
 * @package         Weeby_Testimonial
 */

/**
 * Define variables
 *
 */
 define('WEEBY_TESTIMONY_PLUGIN_NAME', 'Weeby Testimonial');
 
 define('WEEBY_POST_TYPE_TESTIMONY', 'testimony');
 
 define('WEEBY_TESTIMONY_PREFIX', 'testimony_');
 
 define('WEEBY_TESTIMONY_VAR_PREFIX', 'weeby_testimony_');
 
 define('WEEBY_TESTIMONY_TAXONOMY_NAME', 'testimony-category');
 
 define('WEEBY_TESTIMONY_DIR', plugin_dir_path( __FILE__ ) );

 define('WEEBY_TESTIMONY_URL', plugin_dir_url( __FILE__ ) );
 
 
 
 /**
 * Call necessary files and functions
 *
 */

 
require( WEEBY_TESTIMONY_DIR .'post-types/testimony.php');

require( WEEBY_TESTIMONY_DIR .'post-types/testimony-taxonomy.php');
	
require( WEEBY_TESTIMONY_DIR .'add-ons/testimony-addons.php');

require( WEEBY_TESTIMONY_DIR .'inc/testimony-metabox.php');

require( WEEBY_TESTIMONY_DIR .'inc/testimony-shotcodes.php');

require( WEEBY_TESTIMONY_DIR .'inc/testimony-utilites.php');






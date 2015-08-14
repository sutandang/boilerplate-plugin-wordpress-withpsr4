<?php

/**
 *
 * @since             1.0.0
 * @package           Tonjoo Boombar
 *
 * @wordpress-plugin
 * Plugin Name:       Boombar
 * Plugin URI:        -
 * Description:       Plugin Boombar
 * Version:           1.0.0
 * Author:            Eringga Sutandang
 * Author URI:        http://github.com/sutandang
 * License:           GPL
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require __DIR__.'/vendor/autoload.php';

define('TJ_BOOMBAR_BASE_DIR',plugin_dir_path( __FILE__ ));

define('TJ_BOOMBAR_BASE_URL',plugin_dir_url( __FILE__ ));

new \Boombar\Admin\Setting('tonjoo-boombar','1.0.0');

$options = get_option('tonjoo_boombar_value');

new \Boombar\Frontend\Frontend($options);
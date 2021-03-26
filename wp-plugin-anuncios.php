<?php
if(!defined( 'ABSPATH' )) exit;
/*
 * Plugin Name: Wp Plugin Anúncios
 * Plugin URI: https://github.com/rafaelreis96/wp-plugin-anuncios
 * Description: Plugin de anuncios para Wordpress.
 * Version:     1.0
 * Author:      rafaelreis.dev
 * Author URI:  http://rafaelreis.dev
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wppa
*/

if(!function_exists('wppa_get_plugin_path')) {
    function wppa_get_plugin_path() {
        return plugin_dir_path(__FILE__);
    }
}

if(!function_exists('wppa_get_plugin_path')) {
    function wppa_get_plugin_url() {
        return plugin_dir_url(__FILE__);
    }
}

if(is_admin()) {
    require wppa_get_plugin_path() . 'admin/wp-plugin-anuncios-admin.php';
} else {
    require wppa_get_plugin_path() . 'public/wp-plugin-anuncios-public.php';
}

 

/**
 * Install
 */
//require WPPG_PLUGIN_PATH . 'install.php';
//register_activation_hook( __FILE__, array(new Install(), 'activate') );

 
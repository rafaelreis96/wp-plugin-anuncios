<?php

class WPPA_Banner_Post_Type {
    
    public function __construct() {        
        add_action('init', array($this, 'register'));        
    }
    
    public function register() {
        register_post_type('wppa_banners',
            array(
                'labels'      => array(
                    'name'          => __('Banners', 'wppa'),
                    'singular_name' => __('Banner', 'wppa'),
                ),
                'public'      => true,
                'has_archive' => true,
                'supports'    => array('title'),
                'show_in_menu' => false
            )
        );
    }
}
<?php

new WPPA_Public();

class WPPA_Public {
    
    public function __construct() {
        add_action('wp_body_open', array($this, 'add_banner_header'));

    }
    
    public function add_banner_header() {
        
        $query = new WP_Query([
            'post_type' => 'wppa_banners',
            'posts_per_page' => 1
        ]);
        
 
        
        $imagenUrl = wp_get_attachment_image($imagem, 'full', null, ['class'=>'']);
        
        $html = '<h1>Teste</h1>';
        
        echo $html;
    }
    
}
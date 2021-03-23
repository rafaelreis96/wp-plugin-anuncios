<?php

require wppa_get_plugin_path() . 'admin/classes/class-wppa-banner-post-type.php';
require wppa_get_plugin_path() . 'admin/classes/class-wppa-banner-metabox.php';

new Admin();

class Admin {

    public function __construct() {
        new WPPA_Banner_Post_Type();
        new WPPA_Banner_Metabox();
        
        add_action('admin_menu', array($this, 'menu'));
    }
    
    public function menu() {
        add_menu_page(
            __('Anúncios', 'wppa'), //titulo da pagina
            __('Anúncios', 'wppa'), //titulo Menu
            'manage_options',
            'wppa_anuncios', 
            array($this, 'home_page'),
            'dashicons-align-left',
            40 // posição
        );
        
        //Submenus
         add_submenu_page(
            'wppa_anuncios',
            __('Banners', 'wppa'),
            __('Banners', 'wppa'),
            'manage_options',
            'edit.php?post_type=wppa_banners',
            null
        );
    }

    public function home_page() {
        $this->view('WP Anúncios', 'painel');
    }
    
    public function painel_page() {
        $this->view('Banners', 'painel');
    }
    
    public function view($title, $fileName) {
        echo '<div class="wrap">';
        echo '<h1 style="margin-bottom: 10px;">' . __($title ,'wppa') . '</h1>';
        require_once wppa_get_plugin_path() . 'admin/views/' . $fileName . '.php';
        echo '</div>';
    }
    
}

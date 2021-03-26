<?php

require wppa_get_plugin_path() . 'includes/classes/class-banner-model.php';

class WPPA_Banner_Metabox {
    const ID = 'wppa_banner_box_id'; 
    const TITLE = 'Informaçoes do Banner';
    const POSTS_TYPE = 'wppa_banners';
    
    protected $model;

    public function __construct() {
        $this->model = new WPPA_Banner_Model();
        
        add_action('add_meta_boxes', array($this, 'register'));
        add_action('save_post', array($this, 'save_post_data'));
        add_action('admin_enqueue_scripts', array($this, 'styles'));
        add_action('admin_enqueue_scripts', array($this, 'scripts'));
    }
 
    public function styles() {
        wp_enqueue_style('wppa-metabox', wppa_get_plugin_url() . 'admin/css/wppa-banner-metabox.css' );
    }
    
    public function scripts() {
        wp_enqueue_script('wppa-metabox', wppa_get_plugin_url() . 'admin/js/wppa-banner-metabox.js', array ( 'jquery' ), '', true);
    }
    
    public function register() {
        add_meta_box( self::ID, self::TITLE, array($this,'template'), self::POSTS_TYPE );
    }
    
    public function save_post_data(int $post_id) {        
        $this->model->save_data($post_id, $_POST);
    }
 
    public function template() {
        $values = $this->model->get_data(get_the_ID());

        extract($values);
        
        $status =  [
            ['label'=> 'Ativo', 'value' => 'a'],
            ['label'=> 'Expirado', 'value' => 'e'],
            ['label'=> 'Pendente', 'value' => 'p'],
            ['label'=> 'Desativado', 'value' => 'd']
        ];

        $acoesClique = [
            ['label'=> 'Nenhum', 'value' => 'none'],
            ['label'=> '_blank nova guia', 'value' => 'blank'],
            ['label'=> '_self guia atual', 'value' => 'self'],
        ];

        $posicoes = [
            ['label' => 'Manual', 'icon' => 'ads-manual', 'value' => 'manual'],
            ['label' => 'Cabeçalho', 'icon' => 'ads-top', 'value' => 'top'],
            ['label' => 'Centro', 'icon' => 'ads-center', 'value' => 'center'],
            ['label' => 'Rodapé', 'icon' => 'ads-bottom', 'value' => 'bottom'],
        ];
        
        require_once wppa_get_plugin_path() . 'admin/views/metaboxes/new-banner.php';
        
        wp_enqueue_media();
    }
}
<?php

class WPPA_Banner_Metabox {
    const ID = 'wppa_banner_box_id'; 
    const TITLE = 'Informaçoes do Banner';
    const POSTS_TYPES = ['wppa_banners'];
    
    protected $data = [
        'url',
        'acao', 
        'status', 
        'altura',
        'largura', 
        'responsivo',
        'imagem', 
        'posicao',
        'data_publicacao',
        'hora_publicacao',
        'data_expiracao',
        'hora_expiracao'
    ];

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'register'));
        add_action('save_post', array($this, 'save_post_data'));
        add_action('admin_enqueue_scripts', array($this, 'load_styles'));
        add_action('admin_enqueue_scripts', array($this, 'load_scripts'));
    }
 
    public function load_styles() {
        wp_enqueue_style('wppa-metabox', wppa_get_plugin_url() . 'admin/css/wppa-banner-metabox.css' );
    }
    
    public function load_scripts() {
        wp_enqueue_script('wppa-metabox', wppa_get_plugin_url() . 'admin/js/wppa-banner-metabox.js', array ( 'jquery' ), '', true);
    }
    
    public function register() {
        foreach (self::POSTS_TYPES as $postType ) {
            add_meta_box( self::ID, self::TITLE, array($this,'view'), $postType );
        }
    }
    
    public function save_post_data(int $post_id) {        
        $request = $_POST;
        
        if (array_key_exists('url', $request)) {
            foreach ($this->data as $key) {
                update_post_meta($post_id, $key, sanitize_text_field($request[$key]));
            }
        }
    }
 
    public function view() {
        $values = [];
        
        foreach ($this->data as $key) {
           $values[$key] = get_post_meta(get_the_ID(), $key, true);
        }
         
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
            ['label' => 'Cabeçalho', 'icon' => 'ads-top', 'value' => 'header'],
            ['label' => 'Centro', 'icon' => 'ads-center', 'value' => 'center'],
            ['label' => 'Rodapé', 'icon' => 'ads-bottom', 'value' => 'footer'],
        ];
        
        require_once wppa_get_plugin_path() . 'admin/views/metaboxes/new-banner.php';
        
        wp_enqueue_media();
    }
}
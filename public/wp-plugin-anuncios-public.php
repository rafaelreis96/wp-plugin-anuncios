<?php

require_once wppa_get_plugin_path() . 'includes/classes/class-banner-model.php';

new WPPA_Public();

class WPPA_Public {
    
    protected $model;
    
    public function __construct() {
        $this->model = new WPPA_Banner_Model();
                
        add_action('wp_enqueue_scripts', array($this, 'styles'));
        add_action('the_content', array($this, 'add_banners'));
    }
    
    public function styles() {
        wp_enqueue_style('wppa-public', wppa_get_plugin_url() . 'public/css/wppa-public.css' );
    }
    
    public function add_banners($content) {
        $post_id = null;
        $posicoes = ['top', 'center', 'bottom'];

        foreach ($posicoes as $posicao) {
            
            $post_id = $this->model->get_id_post_active([
                            'key'=>'posicao', 
                            'value'=>$posicao, 
                            'compare'=>'='
                        ]);
            
            if(is_int($post_id)) {
                $data = $this->model->get_data($post_id);
                
                if(empty($data) || empty($data['imagem'])) {
                    continue;
                }
                
                $content = $this->banner_template($data, $content);
            }
 
        }
        
        return $content;
    }
    
    private function banner_template($data, $content) {        
        $atributes = [];
        $atributes['class'] = 'wppa-banner-img';
        $imgHtml = wp_get_attachment_image($data['imagem'], 'full', null, $atributes);
        
        if($data['url']) {
            $target = $data['acao'] == 'blank' ? ' target="_blank" ' : '';
            $imgHtml = '<a href="'.$data['url'].'" '.$target.'>'.$imgHtml.'</a>';
        }
        
        if($data['altura']) {
            $atributes['width'] = $data['altura'];
            $atributes['height'] = $data['largura'];
        }
            
        switch($data['posicao']) {
            case 'top':
                $custom = '<div class="wppa-banner-box">'.$imgHtml.'</div>';
                $custom .= $content;
                return $custom;
            case 'center':

                return $custom;
            case 'bottom':
                $custom  = $content;
                $custom .= '<div class="wppa-banner-box">'.$imgHtml.'</div>';
                return $custom;
        }
      
    }
}
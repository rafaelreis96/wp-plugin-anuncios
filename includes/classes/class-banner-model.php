<?php

class WPPA_Banner_Model {
        
    protected $data = [
        'url',
        'acao', 
        'status', 
        'altura',
        'largura', 
        'responsivo',
        'imagem', 
        'posicao',
        'data_inicio',
        'data_expiracao',
    ];
    
    public function save_data(int $post_id, array $values) {      
        foreach ($this->data as $key) {
            update_post_meta($post_id, $key, sanitize_text_field($values[$key]));
        }
    }
    
    public function get_data(int $post_id) {
        $data = [];
        
        foreach ($this->data as $key) {
            $data[$key] = get_post_meta($post_id, $key, true);
        }
 
        return $data;
    }

    
    public function __call($name, $values) {
        $index = strpos($name, '_');
        
        if($index != -1 && isset($values[0])) {
            $key = substr($name, $index+1);
            return get_post_meta($values[0], $key, true);
        }
        
        return null;
    }
}
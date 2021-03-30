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

    public function get_id_post_active($custom_query = null) {
        $data = current_time('Y-m-d');
        
        $meta_query = [
            [
                'key'=>'status', 
                'value'=>'a', 
                'compare'=>'='
            ],
            [
                'key'=>'data_inicio', 
                'value'=> $data, 
                'compare'=>'<=', 
                'type' => 'DATE'
            ],
            [
                'key'=>'data_expiracao', 
                'value'=> $data, 
                'compare'=>'>=', 
                'type' => 'DATE'
            ]
        ];
        
        if($custom_query) {
            $meta_query[] = $custom_query;
        }
        
        $query = new WP_Query([
            'post_type' => 'wppa_banners',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'meta_query' => $meta_query
        ]);
        
        if($query->have_posts()) {
            return $query->posts[0];
        }
        
        return null;
    }
    
    public function get_list_actives() {
        $data = current_time('Y-m-d');
        
        $meta_query = [
            [
                'key'=>'status', 
                'value'=>'a', 
                'compare'=>'='
            ],
            [
                'key'=>'data_inicio', 
                'value'=> $data, 
                'compare'=>'<=', 
                'type' => 'DATE'
            ],
            [
                'key'=>'data_expiracao', 
                'value'=> $data, 
                'compare'=>'>=', 
                'type' => 'DATE'
            ]
        ];
        
         
        $query = new WP_Query([
            'post_type' => 'wppa_banners',
            'posts_per_page' => -1,
            'meta_query' => $meta_query
        ]);
        
         
        return $query->posts;
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
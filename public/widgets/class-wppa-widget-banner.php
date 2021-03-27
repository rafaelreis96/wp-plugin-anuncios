<?php

require_once wppa_get_plugin_path() . 'public/wp-plugin-anuncios-public.php';

add_action('widgets_init', function () {
    return register_widget('WPPA_Widget_Banner');
});

class WPPA_Widget_Banner extends WP_Widget {
    
    protected $model;

    public function __construct() {
        parent::__construct(false,'ADS Banner Widget',array(
            'description' => 'Adicione os banners de anúncios na área de Widgets'
        ));
        
        $this->model = new WPPA_Banner_Model();
    }
    
    public function widget($args, $instance) {
        $post_banner_id = strip_tags($instance['post_banner_id']);
        
        if($post_banner_id) {
            $data = $this->model->get_data($post_banner_id);
            $url = wp_get_attachment_image_url($data['imagem'], 'full');
            
            if($url) {
                echo $before_widget;
                echo '<img class="wppa-widget-banner-img" src="'.$url.'">';
                echo $after_widget;
            }
        }
    }
    
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['post_banner_id'] = strip_tags($new_instance['post_banner_id']);
        
        return $instance;
    }
    
    public function form($instance) {
        $post_banner_id = isset($instance['post_banner_id']) ? esc_attr($instance['post_banner_id']) : '';
        
        $posts = $this->model->get_list_actives();
 
?>
        <p>
            <label for="<?= $this->get_field_id('post_banner_id'); ?>">
                <strong>Selecione o Banner</strong>
            </label></br>
            <select style="width: 100%" id="<?= $this->get_field_id('post_banner_id'); ?>" name="<?= $this->get_field_name('post_banner_id'); ?>">
                <?php foreach($posts as $post): ?>
                <option value="<?=$post->ID?>" <?= $post->ID == $post_banner_id ? 'selected="selected"' : ''?>">
                        <?=$post->post_title?>
                </option>
                <?php endforeach; ?>
            </select>
         </p>
<?php
        
    }
    
}
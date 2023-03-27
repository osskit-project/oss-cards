<?php
/*
 * Oss Cards  Widget
 * Defines the widget to be used to show cards
 */
// class Foo_Widget extends WP_Widget {
class OSS_Cards_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'oss_cards_widget',
            __('OSS Cards Widget', 'oss-cards'),
            array(
                'description' => __('Displays OSS cards based on a specified ID', 'oss-cards'),
            )
        );
        add_action('widgets_init', array($this, 'register_oss_cards_widget'));
    }

    public function widget($args, $instance) {
        $id = !empty($instance['id']) ? $instance['id'] : '';
        
        if( $id ) {
            global $post, $post_type;
            $oss_cards_data = get_post_meta($id, 'oss_cards_data', true);
            $data = json_decode($oss_cards_data, true);
            // Output the widget markup
            echo $args['before_widget'];
            include 'render-cards.php';
            echo $args['after_widget'];
        }
    }

    public function form($instance) {
        $id = ! empty($instance['id']) ? $instance['id'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('id')); ?>"><?php _e('Select Cards:', 'oss-cards'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('id')); ?>" name="<?php echo esc_attr($this->get_field_name('id')); ?>">
                <?php
                $posts = get_posts(array(
                    'post_type' => 'oss_cards',
                    'numberposts' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'post_status' => 'publish',
                ));
                foreach ($posts as $post) {
                    ?>
                    <option value="<?php echo esc_attr($post->ID); ?>"<?php selected($post->ID, $id); ?>><?php echo esc_html($post->post_title); ?></option>
                    <?php
                }
                ?>
            </select>
        </p>
        <?php
    }

    //update widget
    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['id'] = ( ! empty( $new_instance['id'] ) ) ? strip_tags( $new_instance['id'] ) : '';
        return $instance;
    }

    //Register widget
    public function register_oss_cards_widget()
    {
        register_widget('oss_cards_widget');
    }


}

$oss_cards_widget = new OSS_Cards_Widget;
?>
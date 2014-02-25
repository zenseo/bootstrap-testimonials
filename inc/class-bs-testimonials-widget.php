<?php
/**
 * Bootstrap Testimonials Widget
 */
class BS_Testimonials_Widget extends WP_Widget {
 
    /** constructor -- name this the same as the class above */
    function bs_testimonials_widget() {
        parent::WP_Widget(false, $name = 'Bootstrap Testimonials');  
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget( $args, $instance ) { 
        extract( $args );
        $title    = apply_filters( 'widget_title', $instance['title'] );
        $columns = $instance['columns'];
        $orderby = $instance['orderby'];
        $order = $instance['order'];
        $limit = $instance['limit'];
        $include = $instance['include'];        
        $size = $instance['size'];
        $responsive = $instance['responsive'];
        
        
        if ( $include != '' ) $limit = "-1";
        
        if ( $responsive == '1' )
            $responsive = 'true';
        else
            $responsive = 'false';

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
 
        if ( class_exists( 'BS_Testimonials' ) ) {
            $BS_Testimonials = new BS_Testimonials();
            echo $BS_Testimonials->output(array(
                                'columns' => $columns,
                                'orderby' => $orderby,
                                'order' => $order,
                                'limit' => $limit,
                                'include' => $include,                 
                                'size' => $size,
                                'responsive' => $responsive
                                )
                            );                 
        }
        echo $after_widget;        
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['columns'] = strip_tags( $new_instance['columns'] );
    $instance['orderby'] = strip_tags( $new_instance['orderby'] );
    $instance['order'] = strip_tags( $new_instance['order'] );
    $instance['limit'] = strip_tags( $new_instance['limit'] );
    $instance['include'] = strip_tags( $new_instance['include'] );
    $instance['size'] = strip_tags( $new_instance['size'] );
    $instance['responsive'] = strip_tags( $new_instance['responsive'] );
    return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {  
    
        $defaults = array( 
            'title' => 'Testimonials',
            'columns' => '1', 
            'orderby' => 'date',
            'order' => 'DESC',
            'limit' => '',
            'include' => '',
            'size' => '150',                         
            'responsive' => 1             
            );
        $instance = wp_parse_args( (array) $instance, $defaults );   

        $title    = esc_attr($instance['title']);
        $columns  = esc_attr($instance['columns']);
        $orderby  = esc_attr($instance['orderby']);
        $order  = esc_attr($instance['order']);
        $limit  = esc_attr($instance['limit']);
        $include  = esc_attr($instance['include']);
        $size  = esc_attr($instance['size']);
        $responsive = esc_attr($instance['responsive']);

          
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Columns:'); ?></label>
            <select name="<?php echo $this->get_field_name('columns'); ?>" id="<?php echo $this->get_field_id('columns'); ?>" class="widefat">
            <?php
            $options = array('1', '2', '3', '4');
            foreach ($options as $option) {
                echo '<option value="' . lcfirst($option) . '" id="' . $option . '"', $columns == lcfirst($option) ? ' selected="selected"' : '', '>', $option, '</option>';
            }
            ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order By:'); ?></label>
            <select name="<?php echo $this->get_field_name('orderby'); ?>" id="<?php echo $this->get_field_id('orderby'); ?>" class="widefat">
            <?php
            $options = array(
                'None' => 'none', 
                'ID' => 'ID',
                'Name' => 'name', 
                'Date' => 'date',
                'Modified Date' => 'modified',
                'Random' => 'rand' 
                );
            foreach ($options as $name=>$value) {
                echo '<option value="' . $value . '" id="' . $value . '"', $orderby == $value ? ' selected="selected"' : '', '>', $name, '</option>';
            }
            ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:'); ?></label>
            <select name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>" class="widefat">
            <?php
            $options = array(
                'Ascending' => 'ASC', 
                'Descending' => 'DESC'
                );
            foreach ($options as $name=>$value) {
                echo '<option value="' . $value . '" id="' . $value . '"', $order == $value ? ' selected="selected"' : '', '>', $name, '</option>';
            }
            ?>
            </select>
        </p>       
        <p class="limit">
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Maximum amount:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
            <small><?php _e('Leave empty to display all'); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('include'); ?>"><?php _e('Specify Testimonials by ID:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('include'); ?>" name="<?php echo $this->get_field_name('include'); ?>" type="text" value="<?php echo $include; ?>" />
            <small><?php _e('Comma separated list, overrides limit and order settings'); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Image size:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" type="text" value="<?php echo $size; ?>" />
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('responsive'); ?>" name="<?php echo $this->get_field_name('responsive'); ?>" type="checkbox" value="1" <?php checked( '1', $responsive ); ?> />
            <label for="<?php echo $this->get_field_id('responsive'); ?>"><?php _e('Responsive Images'); ?></label>
        </p>       
        <?php
        
    }

} // end class bs_testimonials_widget
add_action('widgets_init', create_function('', 'return register_widget("BS_Testimonials_Widget");'));
?>
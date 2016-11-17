<?php 
/*
Plugin Name: Nominet test plugin
Version: 0.1
Description: Nominet test plugin/widget for upload of image, title, subtitle and button/link for component 5.
Author: Julian Clarke
*/

add_action( 'widgets_init', 'ntp_init' );

function ntp_init() {
	register_widget( 'ntp_widget' );
}

class ntp_widget extends WP_Widget
{

    public function __construct()
    {
        $widget_details = array(
            'classname' => 'ntp_widget',
            'subtitle' => 'Component 5 content imcluding title, subtitle, image and link.'
        );

        parent::__construct( 'ntp_widget', 'Nominet test widget', $widget_details );

        add_action('admin_enqueue_scripts', array($this, 'ntp_assets'));
    }

public function ntp_assets()
{
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('ntp-media-upload', plugin_dir_url(__FILE__) . 'ntp-media-upload.js', array('jquery'));
    wp_enqueue_style('thickbox');
}


    public function widget( $args, $instance )
    {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		?>

		<div class='ntp-subtitle'>
			<?php echo wpautop( esc_html( $instance['subtitle'] ) ) ?>
		</div>

		<div class='npt-image-c5' style='background-image: url(<?php echo $instance['image'] ?>);width: 430px; height: 225px; background-size: cover; background-repeat: no-repeat;'  >
	
		</div>

		<div class='ntp-link'>
			<a href='<?php echo esc_url( $instance['link_url'] ) ?>'><?php echo esc_html( $instance['link_title'] ) ?></a>
		</div>

		<?php

		echo $args['after_widget'];
    }

	public function update( $new_instance, $old_instance ) {  
	    return $new_instance;
	}

    public function form( $instance )
    {

		$title = '';
	    if( !empty( $instance['title'] ) ) {
	        $title = $instance['title'];
	    }

	    $subtitle = '';
	    if( !empty( $instance['subtitle'] ) ) {
	        $subtitle = $instance['subtitle'];
	    }

		$image = '';
		if(isset($instance['image']))
		{
		    $image = $instance['image'];
		}
		$link_url = '';
	    if( !empty( $instance['link_url'] ) ) {
	        $link_url = $instance['link_url'];
	    }

	    $link_title = '';
	    if( !empty( $instance['link_title'] ) ) {
	        $link_title = $instance['link_title'];
	    }

        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'subtitle' ); ?>"><?php _e( 'Subtitle:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" ><?php echo esc_attr( $subtitle ); ?></textarea>
        </p>


        <p>
            <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'BG Image:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'link_url' ); ?>"><?php _e( 'Link URL:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'link_title' ); ?>"><?php _e( 'Link Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'link_title' ); ?>" name="<?php echo $this->get_field_name( 'link_title' ); ?>" type="text" value="<?php echo esc_attr( $link_title ); ?>" />
        </p>
    <?php
    }
}
<?php

/**
 * Adds ESP_subpages_widget widget.
 */

class ESP_subpages_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
		function __construct() {
		parent::__construct(
			'ESP_subpages_widget', // Base ID
			__( 'Subpages', 'espcentrum' ), // Name
			array( 'description' => __( 'A widget that dispays the subpages beneath a level 1 page', 'espcentrum' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

    
    echo $args['before_widget'];
    
		/* Get an array of Ancestors and Parents if they exist */
		global $post;
		$parents = get_post_ancestors( $post->ID );
		// Last item in array is the main parent
		$baseid = $parents ? end($parents) : get_the_ID();
    
		// save the current post date
		$temp = $post;
		// set the post data to the base (parent) post
		$post = get_post( $baseid );
		setup_postdata( $post );
    
		?>


		<h3><?php the_title(); ?></h3>
		<?php echo the_excerpt(); ?>

		<?php
		// reset the post data to the original post
		wp_reset_postdata();
		$post = $temp;
		?>


		<?php



		function esp_exclude_menu_items( $items, $menu, $args ) {
			global $post;
			$parents = get_post_ancestors( $post->ID );
			// Last item in array is the main parent
			$baseid = $parents ? end($parents) : get_the_ID();

			$pages = get_pages('child_of='.$baseid);
      $childpageids = array();
			foreach($pages as $child) {
				array_push($childpageids, $child->ID);
			}

			// Iterate over the items to search and destroy
      foreach ( $items as $key => $item ) {
          if ( !in_array($item->object_id, $childpageids)) unset( $items[$key] );
          // if ( $item->object_id != 8 ) unset( $items[$key] );
      }
      return $items;
		}

		add_filter( 'wp_get_nav_menu_items', 'esp_exclude_menu_items', null, 3 );

		// add wp_nav_menu
		wp_nav_menu( array(
			'container'      => false,
			'menu_class'     => 'sidebarmenu',
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'theme_location' => 'header-menu',
			'depth'          => 3,
			'fallback_cb'    => false
		));

?>


		<?
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) { ?>

		<p><?php _e( 'This widget will display the subpages starting at level 1, including the summary from that page.', 'espcentrum' ); ?></p>

	<?php

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

	}

} // class ESP_subpages_widget

// register ESP_subpages_widget widget
function regisubpages_widget() {
    register_widget( 'ESP_subpages_widget' );
}
add_action( 'widgets_init', 'regisubpages_widget' );
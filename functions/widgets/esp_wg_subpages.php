<?php

class ESP_subpages_widget extends WP_Widget
{
  function __construct()
  {
    parent::__construct(
      // widget ID
      'ESP_subpages_widget',
      // widget name
      __('Subpages', 'espcentrum'),
      // widget description
      array('description' => __('A widget that dispays the subpages beneath a level 1 page', 'espcentrum'),)
    );
  }
  public function widget($args, $instance)
  {
    echo $args['before_widget'];

    /* Get an array of Ancestors and Parents if thezy exist */
		global $post;
    // Last item in array is the main parent
		$baseid = wp_get_post_parent_id($post);
    
    // save the current post date
		$temp = $post;
    // set the post data to the base (parent) post
		$post = get_post( $baseid );
		setup_postdata( $post );

    ?>
      <h3 class="text-xl font-semibold text-primary mb-4"><?php the_title(); ?></h3>
    <?php

		// reset the post data to the original post
		wp_reset_postdata();
		$post = $temp;

    function esp_exclude_menu_items( $items, $menu, $args ) {
			global $post;
      
			$baseid = wp_get_post_parent_id($post);

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
			'theme_location' => 'primary',
			'depth'          => 3,
			'fallback_cb'    => false
		));

    remove_all_filters( 'wp_get_nav_menu_items' );

    echo $args['after_widget'];
  }
  public function form($instance)
  {
    ?>
    <p><?php _e( 'This widget will display the subpages starting at level 1, including the summary from that page.', 'espcentrum' ); ?></p>
    <?php
  }
  public function update($new_instance, $old_instance)
  {
  }
}


function regisubpages_widget()
{
  register_widget('ESP_subpages_widget');
}
add_action('widgets_init', 'regisubpages_widget');
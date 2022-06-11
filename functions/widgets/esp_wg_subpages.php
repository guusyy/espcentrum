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

    $level = count(get_post_ancestors( $post->ID )) + 1;

    // save the current post date
    $temp = $post;
    $baseid = get_the_ID();
    
    if($level > 2) {
      while($level > 2) {
        $baseid = wp_get_post_parent_id($post);
        $post = get_post( $baseid );
        $level = count(get_post_ancestors( $post->ID )) + 1;
      }
    }

    if(wp_get_post_parent_id( $post ) != 21 && wp_get_post_parent_id( $post ) != 0) {
      $baseid = wp_get_post_parent_id($post);
      $post = get_post( $baseid );
      $level = count(get_post_ancestors( $post->ID )) + 1;
    }

		setup_postdata( $post );

    ?>
      <div class="sidenav <?php if($baseid === 18) { echo 'sidenav--praktijk'; } ?> <?php if($baseid === 38) { echo 'sidenav--fysiotherapie'; } ?><?php if($baseid === 40) { echo 'sidenav--medische-fitness'; } ?><?php if($baseid === 42) { echo 'sidenav--leefstijl-interventies'; } ?>">
        <div class="px-5 py-2 rounded-md shadow-md group lg:shadow-none lg:px-0 lg:py-0">
          <div class="flex items-center justify-between group-open:mb-6 lg:mb-6">
            <a class="hover:underline underline-offset-2 text-secondary <?php if($baseid === 38) { echo 'text-themepurple'; } ?><?php if($baseid === 40) { echo 'text-themered'; } ?><?php if($baseid === 42) { echo 'text-themegreen'; } ?>" href="<?php the_permalink();?>">
              <h3
                class="text-xl font-semibold"
              >
                <?php the_title(); ?>
              </h3>
            </a>
            <button class="p-4 group-open:rotate-180 lg:hidden transition-all fill-secondary <?php if($baseid === 38) { echo 'fill-themepurple'; } ?><?php if($baseid === 40) { echo 'fill-themered'; } ?><?php if($baseid === 42) { echo 'fill-themegreen'; } ?>" toggle-open>
              <svg width="18" height="12" viewBox="0 0 18 12" fill="inherit" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.12 0.879999L-3.93402e-07 3L9 12L18 3L15.88 0.879998L9 7.76L2.12 0.879999Z" fill="inherit"/>
              </svg>
            </button>
          </div>
    <?php

    function esp_exclude_menu_items( $items, $menu, $args ) {
			global $post;

			$baseid = get_the_ID();

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

    // reset the post data to the original post
		wp_reset_postdata();
		$post = $temp;

    ?>
        </div>
      </div>
    <?php

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
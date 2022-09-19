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
    echo 'test';
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
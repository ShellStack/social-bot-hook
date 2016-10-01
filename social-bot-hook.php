<?php
/*
Plugin Name: Social bot hook.
Description: This plugin acts as hook for social bot SaaS Service.
*/
function getAllPost() {
  $args = array('posts_per_page' => 1,'orderby' => 'rand');
  $rand_posts = get_posts($args);
  if (empty($rand_posts)) {
        return null;
  }
  return $rand_posts;
}
add_filter('allowed_http_origins','add_allowed_origins');
add_action('wp_head', 'getAllPost');
add_action('rest_api_init', function(){
        register_rest_route( 'socialbot/v1', '/posts/', array(
                'methods' => 'GET',
                'callback' => 'getAllPost',
        ));
});
?>
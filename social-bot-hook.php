<?php
/*
Plugin Name: Social bot hook.
Description: This plugin acts as hook for social bot SaaS Service.
*/
function sbh_retrieve_random_post() {
  $sbhArguement = array('posts_per_page' => 1,'orderby' => 'rand');
  $sbhRandomPost = get_posts($sbhArguement);
  if (empty($sbhRandomPost)) {
        return null;
  }
  return $sbhRandomPost;
}
add_filter('allowed_http_origins','add_allowed_origins');
add_action('wp_head', 'sbh_retrieve_random_post');
add_action('rest_api_init', function(){
        register_rest_route( 'socialbot/v1', '/posts/', array(
                'methods' => 'GET',
                'callback' => 'sbh_retrieve_random_post',
        ));
});
?>

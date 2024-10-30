<?php 
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
function cai_go_delete() {
 $posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'team',
        'post_status' => 'any' ) );

    foreach ( $posts as $post ){
        wp_delete_post( $post->ID, true );
    }
}
cai_go_delete(); 
// deleting all stored data from wpdb.
$cai_customposts = get_posts( array(
    'numberposts' => 2,
    'post_type' => 'team',
    'post_status' => 'any' ) );

foreach ( $cai_customposts as $cai_custompost ) {
    delete_post_meta( $cai_custompost->ID, '_mrlpt_client_email' );
    delete_post_meta( $cai_custompost->ID, '_mrlpt_client_phone_num' );
    delete_post_meta( get_the_ID(), 'cai_email');
     
    delete_post_meta( get_the_ID(), 'cai_position');
   
    delete_post_meta( get_the_ID(), 'cai_abouttext');
   
    delete_post_meta( get_the_ID(), 'cai_fb_link');
   
    delete_post_meta( get_the_ID(), 'cai_insta');
 
    delete_post_meta( get_the_ID(), 'cai_twitter');
     
    delete_post_meta( get_the_ID(), 'cai_youtube');
    wp_delete_post( $cai_custompost->ID, true );
}
delete_option('img_style');   
delete_option( 'layout_style' );   
delete_option( "display");   
delete_option( 'show_num' ); 
delete_option( 'cai_name_color');    
delete_option( 'cai_name_fontweight');    
delete_option( 'cai_name_size');    
delete_option( 'cai_name_align');    
delete_option( 'cai_back_color');    
delete_option( 'cai_modelback');    
delete_option( 'cai_cardback');    
  
    
?>
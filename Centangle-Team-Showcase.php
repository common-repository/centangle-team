<?php
/**
 * Plugin Name: Centangle Team Showcase
 * Plugin URI:  https://wordpress.org/plugins/centangle-team-showcase
 * Description: Team plugin to Show your team members 
 * Version:     1.0.0
 * Author:      Centangle Interactive
 * Author URI:  https://centangle.com/
 * Text Domain: cai_team
 * Domain Path: /languages
 * License:     GPL2
 */ 
 if ( ! defined( 'ABSPATH' ) ) {
	die;
}
//including files

add_filter('generate_rewrite_rules', function ( $ca_rewrite ){
    $ca_rewrite->rules = array_merge(
        ['profile/?$' => 'index.php?id=1'],
        $ca_rewrite->rules
    );
});
add_filter( 'query_vars', function( $cai_queryvars ){
    $cai_queryvars[] = 'id';
    return $cai_queryvars;
} );
add_action( 'template_redirect', function(){   
	global $wp_query;
	$wp_query->is_404 = false;
	status_header( '200' );
    $cai_query_var = intval( get_query_var( 'id' ) );
if ( $cai_query_var ) {   
	   include plugin_dir_path( __FILE__ ) . 'layouts/page_member.php';
die;	
}
});
include("inc_/cai_setting.php");
include("inc_/cai_metabox.php");
//inserting link to settings
function cai_settinglink( $links ) { 
    $url = get_admin_url() . 'admin.php?page=team_settings';
    $settings_link = '<a href="' . $url . '">' . __('Settings', 'CA Team') . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
function cai_aftertheme() {
     add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'cai_settinglink');
}
add_action ('after_setup_theme', 'cai_aftertheme');

/* creating custom post type of team */
function cai_team_custom_posttype() { 
    register_post_type( 'Team',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'CA Team' ),
                'singular_name' => __( 'CA Team' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Team'),
            'supports'            => array( 'title', 'author', 'thumbnail', 'comments', 'revisions', ),'taxonomies'=> array( 'category' ),
            'menu_position'       => 5,
        )
    );
}
/* Hooking up our function to theme setup */
add_action( 'init', 'cai_team_custom_posttype' );
function cai_change_title_text( $cai_change_title ){ 
	// function is called by hook "enter_title_here" for changing placeholder for title field of custom post type
    $cai_post_screen = get_current_screen();
 
    if  ( 'team' == $cai_post_screen->post_type ) {
         $cai_change_title = 'Team Member Name';
    }
 
    return $cai_change_title;
}
add_filter( 'enter_title_here', 'cai_change_title_text' );
/* creating short code */
add_shortcode('team_details', 'cai_team_creat_shortcode');
function cai_team_creat_shortcode($atts){
    extract(shortcode_atts( array( //accepting short code args
        'category'=>'',
        'posts'=>'',
        'order' =>'',
        'postid_to_exclude' =>'',
        'postid_to_inc' =>'',
    ), $atts ));
    global  $cai_shortcode_options; //globel to access in other files
    $cai_shortcode_options= array(
    'category'=>$category,
    'order' => $order,
    'posts_per_page' => $posts,
    'postid_to_inc' => explode(',', $postid_to_inc),
    'postid_to_exclude'=>explode(',', $postid_to_exclude));   
    
    if("cia_pg_view"==get_site_option('layout_style')){
        return include("layouts/detail_layout.php");
    }     
    else   {
        return include("displayteam.php");
    }
    }  
   add_action( 'wp_enqueue_scripts', 'cai_team_enqueue_color_picker' );
   function cai_team_enqueue_color_picker( ) // enqueing color picker
   {
       wp_enqueue_style( 'wp-color-picker' );wp_enqueue_script( 'dp',
       plugins_url( '/assets/js/dp.js', __FILE__ ),
       array( 'jquery'), false, true
   );
   }
   add_action( 'wp_enqueue_scripts', 'cai_team_enquestyle' ); //styles enque
   function cai_team_enquestyle(){
       wp_enqueue_style( 'team',plugins_url( '/assets/css/cai_teamstyle.css', __FILE__ ),true);
       wp_enqueue_style( 'cai_member',plugins_url( '/assets/css/cai_member.css', __FILE__ ),true);
       wp_enqueue_style( 'cai_memberstyle_','https://www.w3schools.com/w3css/4/w3.css');
   }
   add_action( 'admin_enqueue_scripts', 'cai_team_addajax' ); //adding ajax 
   function cai_team_addajax( $hook ) { // ajax function works on delete icon on custom post type while adding skills
       wp_enqueue_script( 'ajax-script',
           plugins_url( '/assets/js/team.js', __FILE__ ),
           array( 'jquery'), false, true
       );
       wp_localize_script( 'ajax-script', 'ajax_object', array(
          'ajax_url' => admin_url( 'admin-ajax.php' ),
       ));
   }
   add_action( 'wp_ajax_cai_ajaxaction', 'cai_ajaxaction' );
function cai_ajaxaction() { //ajax action function gets id of skill and deletes that meta.
    if(isset($_POST['id'])){
   
        if(delete_post_meta(esc_html($_POST['pid']),esc_html($_POST['id'])) && delete_post_meta(esc_html($_POST['pid']),esc_html($_POST['lvlid']))){
           echo "success";
     
        }else{
           echo "not";
        }
     }
       wp_die(); // All ajax handlers die when finished
}
// adding class prev and next buttons
add_filter('next_posts_link_attributes', 'cai_posts_nxt_attributes'); 
add_filter('previous_posts_link_attributes', 'cai_posts_prv_attributes');
function cai_posts_nxt_attributes() {
return 'class="cai-link1 fa fa-chevron-right "';
}
function cai_posts_prv_attributes() {
    return 'class="cai-link1 fa fa-chevron-left"';
}





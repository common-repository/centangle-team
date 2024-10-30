<?php 
if($cai_shortcode_options['posts_per_page']){
    $num_of_post=$cai_shortcode_options['posts_per_page'];
}else{
    $num_of_post=get_option('show_num'); 
}
/*db querying  */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
// query args
if(empty(trim($cai_shortcode_options['postid_to_inc'][0]))){
    $args = array(
        'post_type' => 'Team',
        'posts_per_page' => $num_of_post,
        'category_name'=>$cai_shortcode_options['category'],
        'post_status' => 'publish',
        'post_id' => get_the_ID(),
        'paged' => $paged,
        'order' => $cai_shortcode_options['order'],
        'post__not_in' =>$cai_shortcode_options['postid_to_exclude'],
);
}else{
    $args = array(
        'post_type' => 'Team',
        'posts_per_page' => $num_of_post,
        'category_name'=>$cai_shortcode_options['category'],
        'post_status' => 'publish',
        'post_id' => get_the_ID(),
        'paged' => $paged,
        'order' => $cai_shortcode_options['order'],
        'post__not_in' =>$cai_shortcode_options['postid_to_exclude'], 
        'post__in' => $cai_shortcode_options['postid_to_inc'],    
   
);
}
$cai_htmlstring = '';
    $query = new WP_Query( $args );
    if( $query->have_posts() )
{
        $cai_backcolor=get_option('cai_back_color');
        $cai_htmlstring .= "<div class='flex-container' style='background:".esc_attr($cai_backcolor)."'>";
        $cai_cardid=1;  //
    while( $query->have_posts() ){ // while datbase has posts  
      $query->the_post();
        $cai_htmlstring .= "<div key='myModal".$cai_cardid."' class='cai-container'>";
           $cai_cardcolor=get_option('cai_cardback');
            $cai_htmlstring .= "<div class='cai-card' style='background:".esc_attr($cai_cardcolor)."'>";   
                    $cai_htmlstring .="<div key='myModal$cai_cardid' class='img' img_sty=".esc_attr(get_site_option('img_style')).">";
                        $cai_htmlstring .= get_the_post_thumbnail( null, 'thumbnail' );
                    $cai_htmlstring .=   '</div>';//img
                    $cai_htmlstring .= '<div class="cai-teamcontainer">';
                        $cai_htmlstring .= '<div class="" style="text-align:'.esc_attr((get_option('cai_name_align')) ? esc_attr(get_option('cai_name_align')) : 'center').';text-transform: uppercase;">';
                            $cai_htmlstring .= "<h3 key='myModal$cai_cardid'  style='font-size:".esc_attr(get_option('cai_name_size'))."px !important;font-weight:".esc_attr(get_option('cai_name_weight'))." px !important; color:".esc_attr(get_option('cai_name_color')).";margin: 5px;text-align:".esc_attr((get_option('cai_name_align')) ? esc_attr(get_option('cai_name_align')) : 'center').";' class='cai-card-title'> ".esc_html(get_the_title())." </h3>";
                            $cai_htmlstring .= "<span >".esc_attr(get_post_meta( get_the_ID(), 'cai_position', true ))."</span>"; 
                        $cai_htmlstring .= '</div>';          
                        $cai_htmlstring .= "<div class='cai-social' style='display:".(get_option('display')? get_option('display') : "flex")."'>";
                            $cai_htmlstring .= "<a href='".esc_url(get_post_meta( get_the_ID(), 'cai_fb_link', true ))."' class='fa fa-facebook cai-team-social ' target='_blank'></a>";
                            $cai_htmlstring .= "<a href='".esc_url(get_post_meta( get_the_ID(), 'cai_twitter', true ))."' class='fa fa-twitter cai-team-social' target='_blank'></a>";
                            $cai_htmlstring .= "<a href='".esc_url(get_post_meta( get_the_ID(), 'cai_youtube', true ))."' class='fa fa-youtube cai-team-social' target='_blank'></a>";
                            $cai_htmlstring .= "<a href='".esc_url(get_post_meta( get_the_ID(), 'cai_insta', true ))."' class='fa fa-instagram cai-team-social' target='_blank'></a>";
                        $cai_htmlstring .= '</div>';//social
                    $cai_htmlstring .=   '</div>'; //teamcontainer
            $cai_htmlstring .=   '</div>'; //card
        $cai_htmlstring .=   '</div>'; // cn 

        $cai_htmlstring .= "<div  class='modal' id='myModal".$cai_cardid."' >";
            $cai_htmlstring .= '<div class="modal-content" style="background:'.esc_attr(get_option('cai_modelback')).'">';
                $cai_htmlstring .= ' <div class="modal-header"><span class="close"  data-modal-action="close">&times;</span></div>'; 
                        $cai_htmlstring .='<div class="modal-body">';
                        $cai_htmlstring .= '<div class="cai-model-pic" >';
                        $cai_htmlstring .= " ".get_the_post_thumbnail( null, 'thumbnail')." ";
                        $cai_htmlstring .= '</div>';
                        $cai_htmlstring .= '<div class="cai-model-inner">'; 
                            $cai_htmlstring .=   '<div class="cai-model-title">';
                            $cai_htmlstring .=   '<h3 style="font-size:'.esc_attr(get_option('cai_name_size')).'px !important;margin:5px; font-weight:'.esc_attr(get_option('cai_name_weight')).'px !important; color:'.esc_attr(get_option('cai_name_color')).';" class="cai-card-title">'. esc_attr(get_the_title()).' </h3>';
                            $cai_htmlstring .=   '</div>';
                            $cai_htmlstring .= '<div class="cai-model-social">';
                                $cai_htmlstring .= '<a href="'.esc_url(get_post_meta( get_the_ID(), 'cai_fb_link', true )).'" class="fa fa-facebook cai-team-social  " target="_blank"></a>';
                                $cai_htmlstring .='<a href="'.esc_url(get_post_meta( get_the_ID(), 'cai_twitter', true )).'" class="fa fa-twitter cai-team-social " target="_blank"></a>';
                                $cai_htmlstring .='<a href="'.esc_url(get_post_meta( get_the_ID(), 'cai_youtube', true )).'" class="fa fa-youtube cai-team-social  " target="_blank"></a>';
                                $cai_htmlstring .='<a href="'.esc_url(get_post_meta( get_the_ID(), 'cai_insta', true )).'" class="fa fa-instagram cai-team-social " target="_blank"></a>';
                            $cai_htmlstring .=  '</div>';
                            $cai_htmlstring .= '<div class="cai-model-para">';
                            $cai_htmlstring .= "<span><b>Email: </b>".esc_html(get_post_meta( get_the_ID(), 'cai_email', true )) ."</span><span> |</span><span><b>Position: </b>".get_post_meta( get_the_ID(), 'cai_position', true )."</span><hr>";
                        $cai_htmlstring .= '</div>';
                        $cai_htmlstring .= '<div class="cai-model-content">';
                        $cai_htmlstring .=  "<p class='cai-model-card-text'>" .esc_html(get_post_meta( get_the_ID(), 'cai_abouttext', true )). "</p>";
                        $cai_htmlstring .=  '</div>';
                        $cai_htmlstring .= '</div>';
                    $cai_htmlstring .=  '</div>';     //md body
                $cai_htmlstring .= '</div>';// md conten
            $cai_htmlstring .= '</div>';
++$cai_cardid;
}//while
//for pagination
next_posts_link( '', $query->max_num_pages ); 
previous_posts_link( '',$query->max_num_pages  );
$cai_htmlstring .= '</div>';// flex
}//if
 wp_reset_postdata();
 print($cai_htmlstring );

 
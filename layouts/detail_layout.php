<?php 
if($cai_shortcode_options['posts_per_page']){
    $num_of_post=$cai_shortcode_options['posts_per_page'];
}else{
    $num_of_post=get_option('show_num'); 
}
/*db querying  */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//query args
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
        $cai_cardno=1;   
    while( $query->have_posts() ) // while db has posts 
    {  
        $query->the_post();
        $cai_htmlstring .= '<div key="myModal'.$cai_cardno.'" class="cai-container">';
        $cai_cardcolor=get_option('cai_cardback');
        $cai_htmlstring .=   '<div class="cai-card" style="background:'.$cai_cardcolor.'">';   
            $cai_htmlstring .=   '<a href="'.esc_url(get_site_url()).'/profile?id='.esc_html(get_the_ID()).'"> <div class="cai_img" img_sty="'.esc_attr(get_site_option('img_style')).'">';
                $cai_htmlstring .= get_the_post_thumbnail( null, 'thumbnail' );
                $cai_htmlstring .=   '</div></a>';
            $cai_htmlstring .= '<div class="cai-teamcontainer" >';
                $cai_htmlstring .=   '<div  style="text-align:'.(esc_attr(get_option('cai_name_align')) ? esc_attr(get_option('cai_name_align')) : 'center').';text-transform: uppercase;">';
                $cai_htmlstring .=   "<a href='".esc_url(get_site_url()).'/profile?id='.esc_html(get_the_ID())."'> <h3 key='myModal$cai_cardno'  style='text-transform: uppercase; font-size:".get_option('cai_name_size')."px !important;font-weight:".get_option('cai_name_weight')."px important; color:".get_option('cai_name_color').";margin: 5px;text-align:".(get_option('cai_name_align') ? get_option('cai_name_align') : 'center').";' class='cai-card-title'> ".get_the_title()." </h3> </a>";
                $cai_htmlstring .=   '<span >'.esc_attr(get_post_meta( get_the_ID(), 'cai_position', true )).'</span></div>';
                $cai_htmlstring .= "<div class='cai-social' style='display:".esc_attr(get_option('display'))."'>";
                $cai_htmlstring .= '<a href="'.esc_url(get_post_meta( get_the_ID(), 'cai_fb_link', true )).'" class="fa fa-facebook cai-team-social" target="_blank"></a>';
                $cai_htmlstring .='<a href="'.esc_url(get_post_meta( get_the_ID(), 'cai_twitter', true )).'" class="fa fa-twitter cai-team-social" target="_blank"></a>';
                $cai_htmlstring .='<a href="'.esc_url(get_post_meta( get_the_ID(), 'cai_youtube', true )).'" class="fa fa-youtube cai-team-social" target="_blank"></a>';
                $cai_htmlstring .='<a href="'.esc_url(get_post_meta( get_the_ID(), 'cai_insta', true )).'" class="fa fa-instagram cai-team-social" target="_blank"></a>';
                $cai_htmlstring .= '</div>';
               
            $cai_htmlstring .=   '</div>'; //social icons div

            
    $cai_htmlstring .=   '</div>'; //card div
    
$cai_htmlstring .=   '</div>'; // cn 
}//while
 
next_posts_link( '', $query->max_num_pages ); 
previous_posts_link( '',$query->max_num_pages  );

    $cai_htmlstring .= '</div>';// flex

}//if
 wp_reset_postdata();
 print($cai_htmlstring );

 
<?php 
get_header();
$cai_htmlstring='';
        $cai_htmlstring .='<div class="cai-fullpage-container">';
            $cai_htmlstring .= '<div class="cai-member-pic" >';
              $cai_htmlstring .= "".get_the_post_thumbnail(esc_html($_GET['id']), 'thumbnail')."";
            $cai_htmlstring .= '</div>';//pic
            $cai_htmlstring .= '<div class="cai-member-info">';
                      $cai_htmlstring .= '<div class="cai-member-name">';
                        $cai_htmlstring .= "<h3 style='text-transform: uppercase; font-size:".esc_attr(get_option('cai_name_size'))."px !important;font-weight:".esc_attr(get_option('cai_name_weight'))."px !important; color:".esc_attr(get_option('cai_name_color')).";margin: 5px;' class='cai-card-title'> ". esc_attr(get_the_title(esc_html($_GET['id']))) ."</h3>";
                      $cai_htmlstring .= '</div>';//title name
                      $cai_htmlstring .= '<div class="cai-socialicons">';
                        $cai_htmlstring .= "<a href='".esc_url(get_post_meta(esc_html($_GET['id']), 'cai_fb_link', true ))."' class='fa fa-facebook cai-team-social ' target='_blank'></a>";
                        $cai_htmlstring .= "<a href='".esc_url(get_post_meta(esc_html($_GET['id']), 'cai_twitter', true ))."' class='fa fa-twitter cai-team-social ' target='_blank'></a>";
                        $cai_htmlstring .= "<a href='".esc_url(get_post_meta( esc_html($_GET['id']), 'cai_youtube', true ))."' class='fa fa-youtube cai-team-social ' target='_blank'></a>";
                        $cai_htmlstring .= "<a href='".esc_url(get_post_meta( esc_html($_GET['id']), 'cai_insta', true ))."' class='fa fa-instagram cai-team-social ' target='_blank'></a>";
                      $cai_htmlstring .= '</div>'; //social
                      $cai_htmlstring .= '<div class="cai-member-contact">';
                        $cai_htmlstring .= '<span><b>Email: </b>'.esc_html(get_post_meta(esc_html($_GET['id']), 'cai_email', true )).'</span><span> |</span><span><b>Position:  </b>'.esc_html(get_post_meta(esc_html($_GET['id']), 'cai_position', true )).'</span><hr>';
                      $cai_htmlstring .= '</div>'; //postion
                      $cai_htmlstring .= '<div class="cai-member-about">';
                        $cai_htmlstring .= "<p class='cai-about'> ".esc_html(get_post_meta( esc_html($_GET['id']), 'cai_abouttext', true ))."</p>";
                      $cai_htmlstring .=  '</div>';//about
            $cai_htmlstring .= '</div> '; //member-ss
            $cai_htmlstring .= '<div class="cai-fullpage-container"> ';
                          $cia_skill=0;
                          while(metadata_exists('post',esc_html($_GET['id']), 'cai-skill-text'.$cia_skill)) {
                            $cai_htmlstring .= '<div  class="cai-member-skillbar" > <h3 style="text-transform: uppercase;margin: 6px 3px;" class="card-title">'.esc_html(get_post_meta( esc_html($_GET['id']), 'cai-skill-text'.$cia_skill, true )).'</h3>';
                              $cai_htmlstring .= '<div class="w3-light-grey w3-round-xlarge" style="width:100%">
                              <div class="w3-container w3-green w3-round-xlarge " style="width:'.esc_html(get_post_meta( esc_html($_GET['id']), 'skill-percent'.$cia_skill, true )).'%">'.esc_html(get_post_meta( esc_html($_GET['id']), 'skill-percent'.$cia_skill, true )).'%</div></div>';
                              $cai_htmlstring .= '</div>'; //w3
                            $cia_skill++;
                          } 
                            $cai_htmlstring .= '</div>';//skill bar
            $cai_htmlstring .= '</div>';//con
        $cai_htmlstring .=  '</div>'; //container
                   
 wp_reset_postdata();
 print($cai_htmlstring );
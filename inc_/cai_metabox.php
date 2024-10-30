<?php 
add_action( 'admin_enqueue_scripts', 'cai_metabox_enquestyle' ); //enqueing styles
function cai_metabox_enquestyle(){
    wp_enqueue_style( 'team',plugins_url('assets/css/cai_fontawesome.css',dirname(__FILE__)));
    wp_enqueue_style( 'cai_meta','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css');
}

add_action( 'add_meta_boxes', 'cai_adding_metabox' );//adding metabox in custom post
function cai_adding_metabox()
{
    add_meta_box( 'my-meta-box-id', 'Contact Details', 'cai_metabox_show', 'Team', 'normal', 'high' );
}
function cai_metabox_show() //showing layout of custom post 
{ 
      $j=0;
    ?>
        <div>
                <div ><label for="cai-meta-label"><h2 style="color:#1916ce;font-style: italic;font-size: large;">Member info</h2></label>
                </div><hr style="width:100%;">
        </div>
        <div style="display:flex;">
            <div class="cai-meta-label"><label for="cai-meta-label"><h3>Email</h3></label></div>
            <div class="cia_editmail cai-meta-input">
            <?php $var=get_post_meta(get_the_ID(), "cai_email", true);
            echo '<input size="45" type="text" name="cai_email" value="'.esc_attr($var).'">';?>
            </div>
        </div>
        <div style="display:flex;">
            <div class="cai-meta-label"><label for="cai-meta-label"><h3>Position</h3></label></div>
            <div class="cia-editpos cai-meta-input">
            <?php 
            $va=get_post_meta(get_the_ID(), "cai_position", true);
            echo '<input size="45" type="text" name="cai_position" value="'.esc_attr($va).'">';?>
            </div>
        </div>
        <div style="display:flex;">
            <div class="cai-meta-label"><label for="cai-meta-label"><h3>About</h3></label></div>
            <div class="container3 cai-meta-input">
                <textarea placeholder=""  cols="80" rows="10" name="cai_abouttext"><?php echo esc_html(get_post_meta(get_the_ID(), "cai_abouttext", true));  ?></textarea><p style="font-style: italic;">Add some short bio</p>
            </div>
        </div>
        <div>
            <div ><label for="cai-meta-label"><h2 style="color:#1916ce;font-style: italic;font-size: large;">Social Links</h2></label>
            </div><hr style="width:100%;">
        </div>
        <div style="display:flex;">
            <div class="cai-meta-label"><label for="cai-meta-label"><h3>Facebook </h3></label></div>
            <div class="container4 cai-meta-input">
            <?php echo '<input size="45" type="text" name="cai_fb_link" value='.esc_attr(get_post_meta(get_the_ID(), "cai_fb_link", true)).'>';?>
            </div>
        </div>
        <div style="display:flex;">
            <div class="cai-meta-label"><label for="cai-meta-label"><h3>Twitter </h3></label></div>
            <div class="container5 cai-meta-input">
            <?php echo '<input size="45" type="text" name="cai_twitter" value='.esc_attr(get_post_meta(get_the_ID(), "cai_twitter", true)).'>';?></div>
        </div>
        <div style="display:flex;">
            <div class="cai-meta-label"><label for="cai-meta-label"><h3>Youtube </h3></label></div>
            <div class="container6 cai-meta-input">
            <?php echo '<input size="45" type="text" name="cai_youtube" value='.esc_attr(get_post_meta(get_the_ID(), "cai_youtube", true)).'>';?></div>
        </div>
        <div style="display:flex;">
            <div class="cai-meta-label "><label for="cai-meta-label"><h3>Instagram </h3></label></div>
            <div class="container7 cai-meta-input">
            <?php echo '<input size="45" type="text" name="cai_insta" value='.esc_attr(get_post_meta(get_the_ID(), "cai_insta", true)).'>';?></div>
        </div>
        <div>
            <div ><label for="cai-meta-label"><h2 style="color:#1916ce;font-style: italic;font-size: large;">Skills</h2></label>
            </div><hr style="width:100%;">
        </div>
          <div class="cai-meta-label"><label for="cai-meta-label"><h3>Add Core Skills with level </h3></label></div>
            <div class="container1 cai-meta-input">
                <button  class="add_form_field button button-primary button-large"> 
                    <span style="font-size:16px; font-weight:bold;">Add New</span>
                </button><br>
                <?php $j=0;
                    while (metadata_exists('post',get_the_ID(), 'cai-skill-text'.$j)){
                        $var  =get_post_meta(get_the_ID(), 'cai-skill-text'.$j, true);    
                        $skill_lvl=get_post_meta(get_the_ID(), 'skill-percent'.$j, true);
                        echo '<div class="input"><input postid= "'.esc_attr(get_the_ID()).'" size="45" type="text" id="cai-skill-text'.$j.'" name="cai-skill-text[]" value="'.esc_attr($var).'" required><input postid= "'.esc_attr(get_the_ID()).'" size="25" type="number" id="skill-percent'.$j.'" min="1" max="99" placeholder=" % "name="skill-percent[]" value="'.esc_attr($skill_lvl).'" required/>%<a href="#" class="fa fa-trash delete"></a></div>'; 
                        $j++; 
                    }
                    
                ?> 
            </div>
<?php 
}

/* saving customized post metadata  */
add_action( 'save_post', 'cai_savepost' );
function cai_savepost( $post )
{   
    if( isset( $_POST['cai-skill-text'] ) ){
        $i=0;
        while($i < count($_POST['cai-skill-text'])){
            update_post_meta( get_the_ID(), 'skill-percent'.$i, ( sanitize_text_field($_POST['skill-percent'][$i])) );
            update_post_meta( get_the_ID(), 'cai-skill-text'.$i, ( sanitize_text_field($_POST['cai-skill-text'][$i])) );
        $i++;
        }
    }
    if( isset( $_POST['cai_email'] ) ){
    if (filter_var($_POST['cai_email'], FILTER_VALIDATE_EMAIL)) {
    update_post_meta( get_the_ID(), 'cai_email', ( sanitize_email($_POST['cai_email'])) );
	} 
	}
    if( isset( $_POST['cai_position'] ) )  
    update_post_meta( get_the_ID(), 'cai_position', ( sanitize_text_field($_POST['cai_position'])) );
    if( isset( $_POST['cai_abouttext'] ) )  
    update_post_meta( get_the_ID(), 'cai_abouttext', ( sanitize_text_field($_POST['cai_abouttext'])) );
    if( isset( $_POST['cai_fb_link'] ) )
    update_post_meta( get_the_ID(), 'cai_fb_link', ( sanitize_text_field($_POST['cai_fb_link'])) );
    if( isset( $_POST['cai_insta'] ) )  
    update_post_meta( get_the_ID(), 'cai_insta', ( sanitize_text_field($_POST['cai_insta'])) );
    if( isset( $_POST['cai_twitter'] ) )  
    update_post_meta( get_the_ID(), 'cai_twitter', ( sanitize_text_field($_POST['cai_twitter'])) );
    if( isset( $_POST['cai_youtube'] ) ) 
    update_post_meta( get_the_ID(), 'cai_youtube', ( sanitize_text_field($_POST['cai_youtube'])));
return  ;
}

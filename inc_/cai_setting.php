<?php 
//enqueing js 
add_action( 'admin_enqueue_scripts', 'cai_settingjs' );
/*function cai_settingjs(){
    wp_enqueue_script( 'settings',plugins_url('assets/js/cai_teamsetting.js',dirname(__FILE__)));
}*/
function cai_settingjs( ) {
wp_enqueue_script( 'wp-color-picker' );
wp_enqueue_script('settings',
        plugins_url('assets/js/cai_teamsetting.js',dirname(__FILE__)),
        array( 'wp-color-picker' ), false, true
    );
}
// adding settings menu
add_action('admin_menu', 'register_cit_settings');
function register_cit_settings() {
  add_submenu_page( 'edit.php?post_type=team', 'Settings', 'Settings', 'manage_options', 'team_settings', 'cit_settings' ); 
}
// page for menu
function cit_settings() { ?>
<div class="cai-team-setting" style=" border: 1px solid #ccc;padding: 2%;margin: 1%;">  
  <div class="cai-form-container">
      <ul class="cai-team-tabs"> <!-- tabs to show navigation -->
          <li class="tab-link arrow-top current" data-tab="cai-tab-1">General Settings</li>
          <li class="tab-link" data-tab="cai-tab-2">Styling</li>
          <li class="tab-link" data-tab="cai-tab-3">About Author</li>
      </ul>
        <div id="cai-tab-1" class="cai-tab-content current">
          <form method="post" action="#">
            <h1>CAI Team Settings</h1>
            <table class="cai-table"><!-- table for options -->
              <tr>
                <td><h3>Layout</h3></td>
                <td>
                  <select name="cai_select" >
                    <option value="">Select an option&hellip;</option>
                    <option value="cia_md_view" <?php echo ("cia_md_view"==esc_html(get_option('layout_style')))? 'selected="selected"':'' ?>>Model Layout</option>
                    <option value="cia_pg_view" <?php echo ( "cia_pg_view"==esc_html(get_option('layout_style')))? 'selected="selected"':'' ?> >Page Layout</option>
                  </select>    
                  </td> 
              </tr>
              <tr><td colspan="2"><hr></td></tr>	
              <tr>
                <td><h3>Display Per Page</h3></td>
                <td>
                  <select name="cai_select_perpage" >
                    <option value="">Select an option&hellip;</option>
                    <option value="4" <?php echo ( 4==esc_html(get_option('show_num')))? 'selected="selected"':'' ?>>4 Members</option>
                    <option value="8" <?php echo ( 8==esc_html(get_option('show_num')))? 'selected="selected"':'' ?> >8 Members</option>
                    <option value="12" <?php echo ( 12==esc_html(get_option('show_num')))? 'selected="selected"':'' ?> >12 Members</option>
                    <option value="16" <?php echo ( 16==esc_html(get_option('show_num')))? 'selected="selected"':'' ?> >16 Members</option>
                  </select>    
                  </td> 
              </tr>
              <tr><td colspan="2"><hr></td></tr>	
              <tr>
                <td><h3>Hide Social Icons</h3><p style="font-style: italic;">Icons will be hidden on model and card</p></td>
                <td><input type="checkbox" name="display" value="none" <?php echo ('none'==esc_html(get_site_option('display'))) ? 'checked' : '' ?>>
                </td>
              </tr>
              <tr><td colspan="2"><hr></td></tr>	
              <tr>
              <td><h3>Circular images</h3><p style="font-style: italic;">Pictures will be circualr on model and card for model layout</p></td>
                <td><input type="checkbox" name="img_style" value="100" <?php echo esc_html((get_site_option('img_style'))) ? 'checked' : '' ?>>
                </td>
              </tr>
              <tr><td colspan="2"><hr></td></tr>	
              <tr>
              <td><h3>Short Code</h3><p style="font-style: italic;">Place this short code on your page to show team</p></td>
                <td> <input type="text" name="" value="[team_details]" />
                </td>
              </tr>
              <tr><td colspan="2"><hr></td></tr>	
              <tr>
                <td colspan="2"> <input type="submit" name="Update" id="Update1" class="button button-primary" value="Save Changes">
                </td>
              </tr>
              
        </table>
        </form>
      </div>
      <div id="cai-tab-2" class="cai-tab-content">
          <form method="post" action="#">
            <h1>CAI Team Settings</h1>
            <table class="cai-table">
            <tr>
              <td><h3>Name</h3></td>
                <td> <input type="text" name="cai_name_color" value='<?php echo (get_option('cai_name_color')); ?>' class="my-color-field" />
                </td>
                <td >
                <p><b>Weight:</b></p>
                  <select name="cai_name_weight" >
                    <option value="">Select an option&hellip;</option>
                    <option value="100" <?php echo ("100"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>100</option>
                    <option value="200" <?php echo ("200"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>200</option>
                    <option value="300" <?php echo ("300"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>300</option>                 
                    <option value="400" <?php echo ("400"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>400</option>
                    <option value="500" <?php echo ("500"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>500</option>
                    <option value="600" <?php echo ("600"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>600</option>
                    <option value="700" <?php echo ("700"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>700</option>
                    <option value="800" <?php echo ("800"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>800</option>
                    <option value="900" <?php echo ("900"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>900</option>
                    <option value="initial" <?php echo ("initial"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>initial</option>
                    <option value="inherit" <?php echo ("inherit"==esc_html(get_option('cai_name_fontweight')))? 'selected="selected"':'' ?>>inherit</option>
                    </select>    
                    
                  </td > 
                  <td>
                  <p><b>Size:</b></p>
                  <input placeholder="size in px" type="number" name="cai_name_size" value='<?php echo (esc_attr(get_option('cai_name_size'))); ?>' />px    
                  </td> 
                  <td >
                  <p><b>Align:</b></p>
                  <select name="cai_name_align" >
                    <option value="">Select an option&hellip;</option>
                    <option value="left" <?php echo ("left"==esc_html(get_option('cai_name_align')))? 'selected="selected"':'' ?>>left</option>
                    <option value="right" <?php echo ( "right"==esc_html(get_option('cai_name_align')))? 'selected="selected"':'' ?> >right</option>
                    <option value="start" <?php echo ( "start"==esc_html(get_option('cai_name_align')))? 'selected="selected"':'' ?> >start</option>
                    <option value="end" <?php echo ( "end"==esc_html(get_option('cai_name_align')))? 'selected="selected"':'' ?> >end</option>
                    <option value="center" <?php echo ( "center"==esc_html(get_option('cai_name_align')))? 'selected="selected"':'' ?> >center</option>
                    <option value="inherit" <?php echo ( "inherit"==esc_html(get_option('cai_name_align')))? 'selected="selected"':'' ?> >inherit</option>

                  </select>    
                  </td>
              </tr>
              <tr><td colspan="5"><hr></td></tr>
            <tr>
              <td><h3>Background Color</h3><p style="font-style: italic;">Color will apply on background on page</p></td>
                <td> <input type="text" name="cai_back_color" value='<?php echo (esc_html(get_option('cai_back_color'))); ?>' class="my-color-field" />
                </td>
              </tr>
              <tr><td colspan="5"><hr></td></tr>
              <tr>
              <td><h3>Model Background Color</h3><p style="font-style: italic;">Color will apply on background of model</p></td>
                <td> <input type="text" name="cai_modelback" value='<?php echo (esc_html(get_option('cai_modelback'))); ?>' class="my-color-field" />
                </td>
              </tr>
              <tr><td colspan="5"><hr></td></tr>
              <td><h3>Card Background Color</h3><p style="font-style: italic;">Color will apply on background of cards</p></td>
                <td> <input type="text" name="cai_cardback" value='<?php echo (esc_html(get_option('cai_cardback'))); ?>' class="my-color-field" />
                </td>
              </tr>
              <tr><td colspan="5"><hr></td></tr>
              <tr >
                <td colspan="5"> <input type="submit" name="Update_style" id="Update_style" class="button button-primary" value="Save Changes">
                </td>
              </tr>
            </table>
          </form>
      </div><!-- ta2 -->
    <div id="cai-tab-3" class="cai-tab-content">
      <h1>About Author</h1>
      <p><b>More plugin by centangle:</b></p>
      <p><a href="https://profiles.wordpress.org/centangle/#content-plugins">https://profiles.wordpress.org/centangle</a></p>
      <p>Email: <a href="mailto:hello@centangle.com">hello@centangle.com</a></p>
      <p>twitter: <a href="https://twitter.com/centangle?lang=en">https://twitter.com/centangle</a></p>
      <p>Phone: <a href="tel:+92512825565">+92-51-2825565</a></p>
      twitter.comtwitter.com
      Centangle (@centangle) | Twitter
      The latest Tweets from Centangle (@centangle). Centangle Interactive is an #Islamabad based #DigitalMedia agency providing #Web, #Mobile, #ERP, #POS, #Accounting, #Software and #DigitalMarketing solutions. Islamabad, Pakistan
      <p><b><a href="https://centangle.com/services/web-design-development-company/" target="_blank">Centangle Interactive</a></b> is a digital company based that provides a wide range of services in the digital landscape including, Wordpress Theme Development & Wordpress Plugin Development.</p>
      <p><b>More plugin by centangle:</b></p>
      <p><a href="https://profiles.wordpress.org/centangle/#content-plugins" target="_blank">https://profiles.wordpress.org/centangle</a></p>
      <p>Github: <a href="https://twitter.com/centangle?lang=en" target="_blank">https://twitter.com/centangle</a></p>
      <p>Email: <a href="mailto:hello@centangle.com">hello@centangle.com</a></p>
      <p>twitter: <a href="https://twitter.com/centangle?lang=en" target="_blank">https://twitter.com/centangle</a></p>
      <p>Phone: <a href="tel:+92512825565">+92-51-2825565</a></p>
  </div><!-- tab-3 -->
</div><!-- cai-form-container -->
<?php }
// saving forms/settings
if(isset($_POST['Update'])){ //first tab button
    if(isset($_POST['img_style'])){
        update_option( "img_style", sanitize_text_field($_POST['img_style']));   
    }else{
      delete_option('img_style');   
    }
    if(isset($_POST['cai_select'])){
        update_option( "layout_style", sanitize_text_field($_POST['cai_select'] ));   
    }else{
      delete_option( 'layout_style' );   
    }
    if(isset($_POST['display'])){
        update_option( "display", sanitize_text_field($_POST['display'] ));   
    }else{
      update_option( "display","flex" );   
    }

    if(isset($_POST['cai_select_perpage'])){
        update_option( 'show_num', sanitize_text_field($_POST['cai_select_perpage'])); 
    }else{
      delete_option( 'show_num' ); 
    }
   
} 
if(isset($_POST['Update_style'])){ //saving 2nd tab settings
  if(isset($_POST['cai_name_color'])){
    update_option( "cai_name_color",sanitize_text_field($_POST['cai_name_color']));    
    }else{
   delete_option( 'cai_name_color');    
    }
  if(isset($_POST['cai_name_weight'])){
      update_option( "cai_name_fontweight",sanitize_text_field($_POST['cai_name_weight']));    
      }else{
     delete_option( 'cai_name_fontweight');    
      }
  if(isset($_POST['cai_name_size'])){
        update_option( "cai_name_size",sanitize_text_field($_POST['cai_name_size']));    
        }else{
       delete_option( 'cai_name_size');    
        }
  if(isset($_POST['cai_name_align'])){
          update_option( "cai_name_align",sanitize_text_field($_POST['cai_name_align']));    
          }else{
         delete_option( 'cai_name_align');    
          }
  if(isset($_POST['cai_back_color'])){
            update_option( "cai_back_color",sanitize_text_field($_POST['cai_back_color'] ));    
            }else{
           delete_option( 'cai_back_color');    
            }
  if(isset($_POST['cai_modelback'])){
    update_option( "cai_modelback",sanitize_text_field($_POST['cai_modelback']));    
     }else{
      delete_option( 'cai_modelback');    
    }
    if(isset($_POST['cai_cardback'])){
      update_option( "cai_cardback",sanitize_text_field($_POST['cai_cardback']));    
       }else{
        delete_option( 'cai_cardback');    
      }
}
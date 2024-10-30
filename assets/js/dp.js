jQuery(document).ready(function($) {
  var cai_model;
  jQuery(".cai-card-title").click(function(){
      cai_model=jQuery(this).attr('key');
      jQuery("#"+cai_model).show();
      jQuery("#"+cai_model).show();
   });
   jQuery(".img").click(function(){
    cai_model=jQuery(this).attr('key');
    jQuery("#"+cai_model).show();
    $("#"+cai_model).show();
 });
    var vl=(jQuery('.img').attr('img_sty'))+'%';
    jQuery("img").css({'border-radius':vl});
   jQuery("[data-modal-action=close]").click(function () {
    jQuery('#'+cai_model).hide();
     
 });
});
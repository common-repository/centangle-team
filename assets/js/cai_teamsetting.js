jQuery(document).ready(function ($) {
    console.log("in");
    var tabid;
    jQuery('ul.cai-team-tabs li').on('click', function() {
        
        // controlling tab view in settings
        console.log("in");
        tabid = $(this).attr('data-tab');
        jQuery('ul.cai-team-tabs li').removeClass('current');
        jQuery('.cai-tab-content').removeClass('current');
        jQuery(this).addClass('current');
        jQuery("#" + tabid).addClass('current');
    })
		jQuery('.my-color-field').wpColorPicker();
});
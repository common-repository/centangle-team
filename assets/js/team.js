jQuery(document).ready(function($) {

    var max_fields = 5;
    var wrapper = $(".container1");
    var wrapper1= $(".container2");
    var wrapper3= $(".form");
    var add_button = $(".add_form_field");
    var save_button = $(".Update");
    var add_button1 = $(".add_form_field2");
    var x = $('.input').length;
        console.log( x);
    var k = $('.input1').length;
    jQuery(save_button).click(function(e) {
        e.preventDefault();
        $(wrapper3).append('<div id="mydiv"><br> Added to options</div>');
    });
    setTimeout(function() {
        $("#mydiv").fadeOut().empty();
      }, 5000);
    $(add_button).click(function(e) {
        
        e.preventDefault();
        if (x < max_fields) {
            $(wrapper).append('<div class="input"><input size="45"type="text" id="cai-skill-text'+x+'" name="cai-skill-text[]" required/><input  size="10"type="number" min="1" max="99" placeholder="%" id="skill-percent'+x+'" name="skill-percent[]" required/>%<a href="#" class="fa fa-trash delete"></a></div>'); 
            x++;
            //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        var data = {
            action: "cai_ajaxaction",
            'id': $(this).siblings().attr('id'),'pid':$(this).siblings().attr('postid'),'lvlid':$(this).prev().attr('id'),
		};
        jQuery.post(ajax_object.ajax_url, 
             data
               , function(response) {
                  console.log(response);
               
       });   
        $(this).parent('div').remove();
        
        x--;
        //console.log(x); 
    })  
});
/******************************************
library for background processes like 
-processing 
-dragging 
-waiting while loading
*******************************************/

$(document).ready(function(){


    //to adjest the screen according to 
    //the resolution

    if(screen.width <= 1024)
    {
      $(".body_frame").css('margin-left','100px');
    }
 		
 	
    //hide the waiting if document is ready
 		$(".waiting_shadow").remove();
    $(".background_image_cover").hide();

    //hide pop on click
 		$('.pop_up_close').click(function(){
 			 effect_pop_hide();
       $(".pop_up_body").html("");
       $(".pop_up_title").html("");
 		});

    //show pop on click
    $(".pop_up_open").click(function(){
        effect_pop_show();
    });

    //hide pop on click
     /*$(".black_shadow").click(function(){
        effect_pop_hide();
        $(".pop_up_body").html("");
        $(".pop_up_title").html("Heading");
    });*/



/**************************
progress bar
**************************/

  $( function() {
    $( "#progressbar" ).progressbar({
      value: 0
    });
  });


/*********************************
make something dragable
*********************************/



$( function() {
    $( ".draggable" ).draggable({
      handle: ".draggable_mover",
      //axis: "x",
      //containment: "parent",
      //cursorAt: { top: 5, left: 5 }
    });
  });





});




  


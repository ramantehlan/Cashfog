
$(document).ready(function(){
   

    $(".tooltip_object").hover(function(){
        $(this).find(".tooltip_box").fadeIn(50,"swing");
    },function(){
    	 $(this).find(".tooltip_box").fadeOut(50,"swing");
    });


  });

/*

$(document).ready(function(){
   

    $(".tooltip_object").hover(function(){
        $(this).find(".tooltip_box").show("drop" , {direction: "left"} , 200);
    },function(){
    	 $(this).find(".tooltip_box").hide("drop" , {direction: "right"} , 50);
    });


  });
*/
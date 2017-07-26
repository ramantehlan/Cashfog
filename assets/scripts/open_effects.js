/******************************************************************
This library is to handle all the effect on app of any way

creator:- raman tehlan
date of creation:- 11/12/2016
*****************************************************************/


$(document).ready(function(){

		//effect as per name
		//{effect}_{type of effect}_{direction of effect}_{number in list}
		$(".effect_slide_top_1").show("drop" , {direction: "up"} , 250);
		$(".effect_slide_left_1").show("drop" , {direction: "left"} , 250);
		$(".effect_slide_right_1").show("drop" , {direction: "right"} , 250);

		setTimeout(function(){
			
		$(".effect_slide_top_2").show("drop" , {direction: "up"} , 250);
		$(".effect_slide_left_2").show("drop" , {direction: "left"} , 250);
		$(".effect_slide_right_2").show("drop" , {direction: "right"} , 250);

			setTimeout(function(){
			
				$(".effect_slide_right_3").show("drop" , {direction: "right"} , 250);
				
				setTimeout(function(){
			
						$(".effect_slide_right_4").show("drop" , {direction: "right"} , 250);
				
				},300);

			},300);

		
		},300);
		
});
		
		//this is to annimate any thing
		function effect_show_top(obj){
			$(obj).show("drop"  , {direction: "up"} , 150);
		}

		//function for pop effect
		function effect_pop_hide(){

			 $(".pop_up").hide("drop"  , {direction: "up"} , 150);
             $(".black_shadow").hide("puff" , {pecrent:100},150);


       			$(".pop_up_body").html("");
       			$(".pop_up_title").html("");
		}

		function effect_pop_show(){	

			 $(".pop_up").show("drop"  , {direction: "up"} , 150);
             $(".black_shadow").show("puff" , {pecrent:100},150);
		}

		function effect_processing_show(){

			 $(".processing").show("drop"  , {direction: "up"} , 150);
             $(".black_shadow").show("puff" , {pecrent:100},150);			
		}

		function effect_processing_hide(){

			 $(".processing").hide("drop"  , {direction: "up"} , 150);
             $(".black_shadow").hide("puff" , {pecrent:100},150);			
		}


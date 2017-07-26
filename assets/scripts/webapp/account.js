/**********************************************
this script is to show/delete/edit details

creator:- raman tehlan
date of creation:- 30/12/2016
************************************************/


$(document).ready(function(){

			/**********************************************
			to move table heading to top on scroll 
			***********************************************/

			// Cache selectors outside callback for performance. 
  			$(window).scroll(function(e){ 
 					
 					 var el = $('.table_head'); 
 					 var bo = $(".table_body");

 					 var isPositionFixed = (el.css('position') == 'fixed');
 			
 					//90 is top margin of el element
 					 if ($(this).scrollTop() > 100 && !isPositionFixed){ 
    								el.css({'position': 'fixed', 'top': '0px'}); 
    								bo.css({'marginTop':'81px'});
  					}
  					if ($(this).scrollTop() < 100 && isPositionFixed){
   					 				el.css({'position': 'static', 'top': '0px'}); 
   					 				bo.css({'marginTop':'0px'});
  					} 
			});

			/********************************************8
			hide the transaction details (.account_box)
			hide the options (.active_account_options)
			show account details and close option
			*********************************************/
			$(".show_account_details").click(function(){

					$(".account_box").hide("drop", {direction:"right"} , 400);
					$(".active_account_options").hide("drop", {direction:"right"} , 400);


					setTimeout(function(){
						
						$(".account_body").show("drop" , {direction:"left"} , 400);
						$("#close_details_box").show("drop" , {direction:"left"} , 400);
				
					},500);

			});

			/***********************************************
			hide the transaction details (.account_box)
			hide the options (.active_account_options)
			show edit account box and close button
			************************************************/
			$("#show_edit_box").click(function(){

					$(".account_box").hide("drop", {direction:"right"} , 400);
					$(".active_account_options").hide("drop", {direction:"right"} , 400);
					


					setTimeout(function(){
						
						$(".edit_account_body").show("drop" , {direction:"left"} , 400);
						$("#close_details_box").show("drop" , {direction:"left"} , 400);
				
					},500);

			});


          /******************************************************
		  close any other box then transaction details box and options
		  hide everything else
		  below 2 function are same
          ******************************************************/

			$("#close_details_box").click(function(){

					$(".account_body").hide("drop", {direction:"left"} , 400);
					$(".edit_account_body").hide("drop", {direction:"left"} , 400);
					$("#close_details_box").hide("drop" , {direction:"left"} , 400);

					
					setTimeout(function(){
						
						$(".account_box").show("drop" , {direction:"right"} , 400);
						$(".active_account_options").show("drop", {direction:"right"} , 400);
				
					},500);

				});

		 $(".cancel_edit_account_button").click(function(){
					
					$(".account_body").hide("drop", {direction:"left"} , 400);
					$(".edit_account_body").hide("drop", {direction:"left"} , 400);
					$("#close_details_box").hide("drop" , {direction:"left"} , 400);

					
					setTimeout(function(){
						
						$(".account_box").show("drop" , {direction:"right"} , 400);
						$(".active_account_options").show("drop", {direction:"right"} , 400);
				
					},500);
		 });



});
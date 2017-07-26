$(document).ready(function(){
// Cache selectors outside callback for performance. 
/*function showCoords(event) {
    var x = event.clientX;
    var y = event.clientY;
    var coor = "X coords: " + x + ", Y coords: " + y;
    alert(coor);
}

$(window).hover(showCoords);
*/
  			$(window).scroll(function(e){ 
 					
 					 var el = $('.table_head'); 
 					 var bo = $(".table_body");

 					 var isPositionFixed = (el.css('position') == 'fixed');
 			


 					//90 is top margin of el element
 					 if ($(this).scrollTop() > 90 && !isPositionFixed){ 
    								el.css({'position': 'fixed', 'top': '50px'}); 
    								bo.css({'marginTop':'71px'});
  					}
  					if ($(this).scrollTop() < 90 && isPositionFixed){
   					 				el.css({'position': 'static', 'top': '50px'}); 
   					 				bo.css({'marginTop':'0px'});
  					} 
  					
			});
});

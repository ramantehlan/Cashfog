// To save it in data base
function update(){
  let data = $(".sortable").sortable('serialize');

  alert(data);
}

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



      $( ".sortable" ).sortable({
           placeholder: "ui-state-highlight",
           helper: 'clone',
           handle: ".sortable_handle",
           update: function( event, ui ) {
            var data = $(".sortable").sortable('serialize' , { key: "id" });

            $.post( $("#record_list_link").val() , {data:data } , function(response){
                 $("#record_list_area").html(response);
             });
          }

    }).disableSelection();

});

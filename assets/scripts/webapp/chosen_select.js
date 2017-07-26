/***************************************************
this script help in making select more ui-friendly
it is also taking help of

chosen.jquery.js
chosen.css
chosen_select.css


creator:- raman tehlan
date of creation:- 31/12/2016
**************************************************/


$(document).ready(function(){

	$(".chosen_select").chosen();

	//this is to make those select into chosen which
	//are animated
	setTimeout(function(){
		$(".delay_chosen_select").chosen();
	},600);

});

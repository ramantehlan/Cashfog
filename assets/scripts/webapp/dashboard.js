

//this function is to update expense/income pie chart
function update_exin_pie(action_type){
	
	var financial_period = $("#reset_financial_period").val();
	var country = $("#reset_country").val();	
	var currency = $("#reset_currency").val();	
	var language = $("#reset_language").val();

	if(action_type == 't2'){
			var year = $("#income_chart_year").val();
			var month = $("#income_chart_month").val();
			var action = $(".income_action");	
	}else{
			var year = $("#expense_chart_year").val();
			var month = $("#expense_chart_month").val();
			var action = $(".expense_action");
	}


		action.show();
		action.html("Updating...");

	
	$.post( $("#reset_link_2").val() , { action_type:action_type , year:year , month:month  , financial_period:financial_period , currency:currency , country:country  , language:language} , function(response){
	 	action.html(response);
	 });
}

//this function is to update expense/income line chart
function update_exin_chart(){

	var year = $("#exin_year").val();	
	var country = $("#reset_country").val();	
	var currency = $("#reset_currency").val();	
	var financial_period = $("#reset_financial_period").val();	
	var language = $("#reset_language").val();



		$(".exin_action").show();
		$(".exin_action").html("Updating...");

		//this is to stop user from using chart while it 
		//is beingh updated
		$("#exin_cover").show();

	
	$.post( $("#reset_link_3").val() , {year:year  , country:country , currency:currency , financial_period:financial_period , language:language} , function(response){
	 	$(".exin_action").html(response);
	 });

}


//updating the sales chart

function update_sale_purchase(request_type){

	var country = $("#reset_country").val();	
	var currency = $("#reset_currency").val();	
	var financial_period = $("#reset_financial_period").val();	
	var language = $("#reset_language").val();	

	if(request_type == "sale"){
		var year = $("#sales_year").val();
		var account_id = $("#sales_account").val();
		var action = $(".sales_action");
		var cover = $("#sales_cover");
	}else if(request_type == "purchase"){
		var year = $("#purchase_year").val();
		var account_id = $("#purchase_account").val();
		var action = $(".purchase_action");
		var cover = $("#purchase_cover");
	}


	action.show();
	action.html("Updating...");

		//this is to stop user from using chart while it 
		//is beingh updated
		cover.show();

	
	$.post( $("#reset_link_4").val() , {year:year  , country:country , currency:currency , financial_period:financial_period , language:language , account_id:account_id , request_type:request_type} , function(response){
	 	action.html(response);
	 });

}


function update_balance(request_type){
	var country = $("#reset_country").val();	
	var currency = $("#reset_currency").val();	
	var financial_period = $("#reset_financial_period").val();	

	if(request_type == "sale"){

		var account_id = $("#receivable_account").val();
		var action = $(".receivable_action");

	}else if(request_type == "purchase"){

		var account_id = $("#payable_account").val();
		var action = $(".payable_action");

	}

	action.show();
	action.html("Updating...");
	
	$.post( $("#reset_link_1").val() , {country:country , currency:currency , financial_period:financial_period , account_id:account_id , request_type:request_type} , function(response){
	 	action.html(response);
	 });
}


$(document).ready(function(){



$("#expense_chart_year").change(function(){update_exin_pie('t1');});
$("#expense_chart_month").change(function(){update_exin_pie('t1');});

$("#income_chart_year").change(function(){update_exin_pie('t2');});
$("#income_chart_month").change(function(){update_exin_pie('t2');});

$("#exin_year").change(update_exin_chart);

$("#sales_account").change(function(){update_sale_purchase("sale")});
$("#sales_year").change(function(){update_sale_purchase("sale")});
$("#purchase_account").change(function(){update_sale_purchase("purchase")});
$("#purchase_year").change(function(){update_sale_purchase("purchase")});

$("#receivable_account").change(function(){update_balance("sale")});
$("#payable_account").change(function(){update_balance("purchase")});




});

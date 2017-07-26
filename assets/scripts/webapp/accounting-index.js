function update_transactions(){

	
	var year = $("#transactions_year").val();	
	var country = $("#reset_country").val();	
	var currency = $("#reset_currency").val();	
	var financial_period = $("#reset_financial_period").val();


		$(".transactions_action").show();
		$(".transactions_action").html("Updating...");

	
	$.post( $("#transaction_reset_link").val() , {year:year , country:country , currency:currency , financial_period:financial_period} , function(response){
	 	$(".transactions_action").html(response);
	 });
	
}

$(document).ready(function(){

		//to show the record activity box for 
		//transition
		$("#show_record_transaction_button").click(function(){

				//to scroll to top
				window.scrollTo(0, 0);
				//to hide
				$(".index_intro").hide("drop", {direction:"right"} , 400);

				setTimeout(function(){
						
						$(".record_activity_box").show("drop" , {direction:"left"} , 400);
				        $(".close_all_button").show(200);
				},500);
				


		});


		//to show create account box and hide other options
		$("#create_account").click(function(){

				//to scroll to top
				window.scrollTo(0, 0);
				//to hide
				$(".index_intro").hide("drop", {direction:"right"} , 400);
				
				setTimeout(function(){

						$(".create_account_box").show("drop" , {direction:"left"} , 400);
						$(".close_all_button").show(200);
				},500);

		});
		

		//to show import data box and hide other options
		$("#import_data").click(function(){

				//to scroll to top
				window.scrollTo(0, 0);
				//to hide
				$(".index_intro").hide("drop", {direction:"right"} , 400);
				
				setTimeout(function(){

						$(".import_data_box").show("drop" , {direction:"left"} , 400);
						$(".close_all_button").show( 200);
				},500);

		});

		//to show edit_accounting box and hide other options
		$("#edit_accounting").click(function(){

				//to scroll to top
				window.scrollTo(0, 0);
				//to hide
				$(".index_intro").hide("drop", {direction:"right"} , 400);
				
				setTimeout(function(){

						$(".account_edit_box").show("drop" , {direction:"left"} , 400);
						$(".close_all_button").show( 200);
				},500);

		});

		//to hide create account box and show other options
		$(".close_all_button").click(function(){

			//to scroll to top
			window.scrollTo(0, 0);
			//to hide
			//here it is 400 cause it take time to scrool up
			$(".create_account_box").hide("drop" , {direction:"left"} , 400);
			$(".record_activity_box").hide("drop" , {direction:"left"} , 400);
			$(".import_data_box").hide("drop" , {direction:"left"} , 400);
			$(".account_edit_box").hide("drop" , {direction:"left"} , 400);
			$(".close_all_button").hide();

					setTimeout(function(){

					$(".index_intro").show("drop", {direction:"right"} , 400);

			},500);

		});

		/*********************************************

		************************************************/

		$("#transactions_year").change(update_transactions);

		/************************************************

		****************************************************/
		$('#account_type').change(function(){ 

				var account_type = document.getElementById("account_type").value;

				//this is the error handeling divs
				var error_box 	 	  = $(".create_account_error");
				var success_box 	  = $(".create_account_success");

				//to hide error or success when changing the type
				error_box.hide();
				success_box.hide();

				//if ledger type is empty just hide everything
				if(account_type.length == 0){
					//hide all the suff
					$(".create_account_fragment").hide("drop" , {direction : "left"} , 400);
				}else{
					//show stuff according to the choice
					$(".create_account_fragment").hide("drop" , {direction : "left"} , 400);

					setTimeout(function(){


						switch(account_type){
							case 'le2':
									$('.hide_group_1').hide();
							break;
							case 'le3':
									$('.hide_group_1').hide();
							break;
							case 'le4':
									$('.hide_group_1').hide();
							break;
							default:
									$(".hide_group_1").show();
							break;
						}

						$(".create_account_fragment").show("drop" , {direction : "left"} , 400);

					},500);

				}

		 });

		

});



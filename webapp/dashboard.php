<?php
// Script start
//$rustart = getrusage();

//place this before any script you want to calculate time
//$time_start = microtime(true); 

session_start();

//this is to highlight the name of page in nevigation
$page_name = "dashboard";

//bundle.inc is bundle of comman includes
include "../includes/bundle.inc.php";


?>
<!DOCTYPE html>
<html>
<head>
	<title>
	 	 <?php echo $lang['dashboard']; ?> | <?php echo ucfirst(app_name); ?>
	</title>

	<meta charset="UTF-8">

	  <?php 
	  		include "../includes/fragments/webapp/header-files.fragment.php";
	  ?>
	  
	  	 

	      <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>dashboard-ui.css">

	  	<script type="text/javascript" src="<?php echo script; ?>form-check.js"></script>	
	  	<script type="text/javascript" src="<?php echo script; ?>chart.js"></script>	
	    <script type='text/javascript' src='<?php echo script_app; ?>dashboard.js'></script>   
							




</head>
<body>
 		
		<?php 

		 include "../includes/fragments/webapp/background.fragment.php";

		 include "../includes/fragments/webapp/topbar.fragment.php";

		 include "../includes/fragments/webapp/leftmenu.dashboard.fragment.php";

		?>
 	    
 	    <div class="body_frame scroll_object">

        <?php 
                if( $VERIFICATION_CODE != ""){
         ?>
            <div class='notification'>
                    Please verify your email by clicking on the link sent to you.
            </div>

        <?php 
            }
        ?>


<?php 
		 
         $period = $decode -> financial_period($FINANCIAL_PERIOD);
 		 $current_financial_year = $period[2];


        $exin_data = $access -> book('le4' , true , $current_financial_year);		
       
        $chart_expense_data = $access -> book_source( 'le4' , 't1' , $current_financial_year );
        $chart_income_data = $access -> book_source( 'le4' , 't2' , $current_financial_year );
        $chart_exin_data = $access -> book_monthly( 'le4' , $current_financial_year);


        $sale = $access -> action_group("sale" , $current_financial_year);
        $purchase = $access -> action_group("purchase" , $current_financial_year);
  
        $sale_monthly = $access -> action_monthly("a1" , $current_financial_year);
        $payment_received_monthly = $access -> action_monthly("a2" , $current_financial_year);
        $payment_paid_monthly = $access -> action_monthly("a3" , $current_financial_year);
        $purchase_monthly = $access -> action_monthly("a4" , $current_financial_year);
        $debit_note_monthly = $access -> action_monthly("a5" , $current_financial_year);
        $credit_note_monthly = $access -> action_monthly("a6" , $current_financial_year);



        $years_option = "";
 
        $year_sql = mysqli_query($connect , "SELECT DISTINCT(YEAR(`DATE_OF_TRANSACTION`)) AS 'year' FROM `$db_name`.`$transactions_table` where OWNER_ID = '$USER_ID' ORDER by `year` DESC;");
        $no_of_years = mysqli_num_rows($year_sql);

        if($no_of_years == 0){
            $years_option .= "<option Selected value='$current_financial_year'>$current_financial_year - " . ($current_financial_year + 1) . " </option>";
        }else{
            //starting of financial month is less then current month
            //so new financial year havn't started
            if(date('Y') == $current_financial_year){
                $current_year = date('Y');
                $next_year = date('Y') + 1;
                $years_option .= "<option selected value='$current_year'>$current_year - $next_year</option>";
            }

            while($_years = mysqli_fetch_array($year_sql)){
                $year = $_years['year'];
                if($year != date("Y")){
                     $years_option .= "<option value='$year'>$year - " . ($year + 1) . "</option>";
                 }
            }
            $years_option .= "<option value='" . ($year-1) . "'>" . ($year - 1) . " - $year</option>";
        }  


        function get_options($action_type){
        global $connect , $db_name , $transactions_table , $USER_ID , $accounts_table;

        $option = "";

        //GETTING DATA OF ACCOUND ID LIST FOR OWNER ID AND ACCOUNT TYPE
        $list_command = mysqli_query($connect , "SELECT DISTINCT(ACCOUNT_ID) FROM `$db_name`.`$transactions_table` WHERE `OWNER_ID` = '$USER_ID' AND `TRANSACTION_ACTION` = '$action_type'");
        $no_of_item = mysqli_num_rows($list_command);

        if($no_of_item > 0){
            //this is to store the list of account as a sql format
            $list = "";
            
            while($_LIST = mysqli_fetch_array($list_command)){
                $list .= " `ACCOUNT_ID` = " . $_LIST['ACCOUNT_ID'] . " or" ;
            }
            //this is to replace last or of the string
            $list = " ( " . substr($list, 0, -2) . " ) AND" ;

            $list_command_2 = mysqli_query($connect , "SELECT * FROM `$db_name`.`$accounts_table` WHERE  $list `OWNER_ID` = '$USER_ID'");

            //THIS IS TO CREATE OPTIONS 
            while($_OPTION = mysqli_fetch_array($list_command_2)){
                $option .= "<option value='" . $_OPTION['ACCOUNT_ID'] . "'> " . $_OPTION['ACCOUNT_TITLE'] . "</option>";
            }
        }

        return $option;
    }


    //we are assigning a variable instead of 
    //calling function directly to same 2 extra calls
    $sales_options = get_options("a1");
    $purchase_options = get_options("a4");
                                

?>
 	    <input type='hidden' id='reset_link_1' value='<?php echo action_app; ?>reset_balance.php'>
        <input type='hidden' id='reset_link_2' value='<?php echo action_app; ?>reset_expense_income.php'>
        <input type='hidden' id='reset_link_3' value='<?php echo action_app; ?>reset_exin_chart.php'>
        <input type='hidden' id='reset_link_4' value='<?php echo action_app; ?>reset_sale_purchase.php'>
    	<input type='hidden' id='reset_country' value='<?php echo $COUNTRY; ?>'>
    	<input type='hidden' id='reset_currency' value='<?php echo $CURRENCY; ?>'>
        <input type='hidden' id='reset_financial_period' value='<?php echo $FINANCIAL_PERIOD; ?>'>
    	<input type='hidden' id='reset_language' value='<?php echo $LANGUAGE; ?>'>

        <div class='group_0'>

       
               <div class='box_receive box_body dark_box_body effect_slide_right_1'>
                        <div class="box_body_top">
                                <div class="box_heading small_head heading_receive">
                                    <img src="<?php echo image_icon; ?>receivable.png" > <?php echo $lang['receivable'] ?>
                                </div>

                                 <div class='canvas_option_box option_box_1'>
                                      
                                    <?php echo $lang['from'] ?> <select  id="receivable_account"   class="chosen_select select_input input canvas_option_input capital" style='width:160px;'  tabindex="5">
                                                 <option value=""><?php echo $lang['all']; ?></option>  
                                                 <?php 
                                                       echo $sales_options;
                                                 ?>  
                                              </select>

                                </div>
                        </div>
                        <div class="option_box_action receivable_action"></div>
                        <div class='box_content ' id='receivable_content' >
                                <?php echo $decode -> money($sale[3] , $COUNTRY , $CURRENCY ); ?> 
                        </div>
               </div>

               <div class='box_pay box_body dark_box_body effect_slide_right_2'>
                        <div class="box_body_top">
                                <div class="box_heading small_head heading_pay">
                                    <img src="<?php echo image_icon; ?>payable.png" >  <?php echo $lang['payable'] ?>
                                </div>
                                <div class='canvas_option_box option_box_1'>
                                  
                                <?php echo $lang['to']; ?> <select  id="payable_account"  class="delay_chosen_select select_input input canvas_option_input capital" style='width:160px;'  tabindex="5">
                                                 <option value=""><?php echo $lang['all']; ?></option>  
                                                 <?php 
                                                       echo $purchase_options;
                                                 ?>   
                                    </select>

                                </div>
                        </div>
                        <div class="option_box_action payable_action"></div>
                        <div class='box_content' id='payable_content'>
                                <?php echo $decode -> money($purchase[3] , $COUNTRY , $CURRENCY ); ?>
                            
                        </div>
               </div>
    
        </div>

<div class='group_1'>
                
                <div class="box_sales box_body dark_box_body ">
                  <div class='box_body_top '>
                    <div class="box_heading heading_sales">
                         <img src="<?php echo image_icon; ?>sales_graph.png" > <?php echo $lang['sales'] ?>
                    </div>
                    <div class='canvas_option_box option_box_1'>
                                  
                                <?php echo $lang['to'] ?> <select  id="sales_account"   class="chosen_select select_input input canvas_option_input capital" style='width:250px;'  tabindex="5">
                                                 <option value=""><?php echo $lang['all'] ?></option>  
                                                <?php 
                                                       echo $sales_options;
                                                 ?>  
                                              </select>
                                <?php echo $lang['for'] ?>
                                <select id='sales_year' class='input select_input canvas_option_input'>

                                    <?php 
                                            echo $years_option;
                                    ?>
                                    
                                </select>

                        </div>
                  </div>
                        <div class="option_box_action sales_action"></div>

                        <div id='sales_box'>
                                <div class='canvas_cover' id='sales_cover'></div>
                                <canvas id='sales'></canvas>
                        </div>

                        <div class='details_of_cashflow '>
                            
                            <div class='row_of_details'>
                                <div class='head_of_details capital'>+ <?php echo $lang['total'] . " " . $lang['sales']; ?></div> 
                                <div class='body_of_details' id='sales_content'><?php echo $decode -> money($sale[0] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'>- <?php echo $lang['total'] . " " . $lang['payment_received']; ?></div> 
                                <div class='body_of_details' id='payment_received_content'><?php echo $decode -> money($sale[1] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'>+ <?php echo $lang['previous_receivable']; ?></div> 
                                <div class='body_of_details' id='prerec_content'><?php echo $decode -> money( $sale[2] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            
                            <div class='row_of_details imp_detail'>
                                <div class='head_of_details capital'>= <?php echo $lang['total_receivable']; ?></div> 
                                <div class='body_of_details' id='totrec_paid_content'><?php echo $decode -> money($sale[3] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'> <?php echo $lang['total'] . " " . $lang['debit_note_received']; ?></div> 
                                <div class='body_of_details' id='debit_note_received_content'><?php echo $decode -> money($sale[4] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                           
                        </div>
                </div>


        </div>

        <div class='group_1'>
                
                <div class="box_purchase box_body dark_box_body ">
                  <div class='box_body_top '>
                    <div class="box_heading heading_purchase">
                         <img src="<?php echo image_icon; ?>sales_graph.png" > <?php echo $lang['purchase']; ?>
                    </div>
                    <div class='canvas_option_box option_box_1'>
                                  
                                <?php echo $lang['from'] ?> <select  id="purchase_account" class="chosen_select select_input input canvas_option_input capital" style='width:250px;'  tabindex="5">
                                                 <option value=""><?php echo $lang['all'] ?></option>
                                                 <?php 
                                                       echo $purchase_options;
                                                 ?> 
                                              </select>
                                <?php echo $lang['for'] ?>
                                <select id='purchase_year' class='input select_input canvas_option_input'>

                                    <?php 
                                            echo $years_option;
                                    ?>
                                    
                                </select>

                        </div>
                  </div>
                        <div class="option_box_action purchase_action"></div>

                        <div id='purchase_box'>
                                <div class='canvas_cover' id='purchase_cover'></div>
                                <canvas id='purchase'></canvas>
                        </div>

                        <div class='details_of_cashflow'>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'>+ <?php echo $lang['total'] . " " . $lang['purchase']; ?></div> 
                                <div class='body_of_details' id='purchase_content'><?php echo $decode -> money($purchase[0] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'>- <?php echo $lang['total'] . " " . $lang['payment_paid']; ?></div> 
                                <div class='body_of_details' id='payment_paid_content'><?php echo $decode -> money($purchase[1] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'>+ <?php echo $lang['previous_payable']; ?></div> 
                                <div class='body_of_details' id='prepay_content'><?php echo $decode -> money($purchase[2] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            
                            <div class='row_of_details imp_detail'>
                                <div class='head_of_details capital'>= <?php echo $lang['total_payable']; ?></div> 
                                <div class='body_of_details' id='totpay_content'><?php echo $decode -> money($purchase[3] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'> <?php echo $lang['total'] . " " . $lang['debit_note_sent']; ?></div> 
                                <div class='body_of_details' id='debit_note_sent_content'><?php echo $decode -> money($purchase[4] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            
                        </div>
                </div>


        </div>

        <div class='group_2'>
 	   		    <div class='box_expense box_body dark_box_body'>
 	    	   			<div class="box_body_top">
 	    	   					<div class="box_heading heading_expense capital">
 	    	   						<img src="<?php echo image_icon; ?>sales_pie.png" > <?php echo $lang['expense']; ?>
 	    	   					</div>
                                <div class='canvas_option_box option_box_1'>
                                
                                
                                <select class='input select_input canvas_option_input' id='expense_chart_year'>
                                    <?php 
                                            echo $years_option;
                                    ?>
                                </select>
                                 
                                <select class='input select_input canvas_option_input' style='width:80px;' id='expense_chart_month'>
                                    <option selected value='00'><?php echo $lang['all']; ?></option>
                                    <?php 
                                            $list_months    =  explode(",", $period[4]); 
                                            $list_months_nos =  $period[3]; 

                                            for($n = 0; 12 > $n; $n++){

                                                $list_months[$n] = str_replace("'", "",  $list_months[$n]);
                                                echo "<option value='" . $list_months_nos[$n] . "'>" . $list_months[$n] . "</option>";
                                                
                                            }
                                    ?>

                                </select>
                        </div>
 	    	   	</div>
 	    	   			 
 	    	   			<div class="option_box_action expense_action"></div>
                        <div class='box_data' id='expense_value'><?php echo $decode -> money($chart_expense_data[0] , $COUNTRY , $CURRENCY ); ?></div>
 	    	   			<div id='expense_box'><canvas id="expense" ></canvas></div>
 	    	   </div>

                <div class='box_income box_body dark_box_body'>
                        <div class="box_body_top">
                                <div class="box_heading heading_income capital">
                                    <img src="<?php echo image_icon; ?>sales_pie.png" > <?php echo $lang['income']; ?>
                                </div>
                                 <div class='canvas_option_box option_box_1'>
                            
                                <select class='input select_input canvas_option_input' id='income_chart_year'>
                                     <?php 
                                            echo $years_option;
                                    ?>
                                </select>
                                 
                                <select class='input select_input canvas_option_input' style='width:80px;' id='income_chart_month'>
                                    <option selected value='00'><?php echo $lang['all']; ?></option>
                                    <?php 
                                            $list_months    =  explode(",", $period[4]); 
                                            $list_months_nos =  $period[3]; 

                                            for($n = 0; 12 > $n; $n++){

                                                $list_months[$n] = preg_replace('/[^A-Za-z0-9\-]/', "",  $list_months[$n]);
                                                echo "<option value='" . $list_months_nos[$n] . "'>" . $list_months[$n] . "</option>";
                                            }
                                    ?>

                                </select>
                                </div>
                        </div>
                        
                       
                        <div class="option_box_action income_action"></div>
                        <div class='box_data' id='income_value'><?php echo $decode -> money($chart_income_data[0] , $COUNTRY , $CURRENCY ); ?></div>
                        <div id='income_box'><canvas id="income" ></canvas></div>
               </div>

 	  
            </div>

             <div class='box_exin_chart box_body dark_box_body'>
                        <div class="box_body_top">
                                <div class="box_heading heading_income">
                                    <img src="<?php echo image_icon; ?>sales_graph.png" > <?php echo $lang['expense_income']; ?>
                                </div>
                                 <div class='canvas_option_box option_box_1'>
                                    <?php echo $lang['for'] ?>
                                    <select id='exin_year' class='input select_input canvas_option_input'>

                                    <?php 
                                            echo $years_option;
                                    ?>
                                    
                                    </select>
                                </div>
                        </div>
                        
                       
                        <div class="option_box_action exin_action"></div>
                        <div id='exin_box'>
                            <div class='canvas_cover' id='exin_cover'></div>
                            <canvas id="exin" ></canvas>
                        </div>

                         <div class='details_of_cashflow exin_details'>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'><?php echo $lang['expense']; ?></div> 
                                <div class='body_of_details' id='expense_content'><?php echo $decode -> money($exin_data[0] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'><?php echo $lang['income']; ?></div> 
                                <div class='body_of_details' id='income_content'><?php echo $decode -> money($exin_data[1] , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'><?php echo $lang['average_month'] . " " .$lang['expense']; ?></div> 
                                <div class='body_of_details' id='month_expense_content'><?php echo $decode -> money( ($exin_data[0] / 12) , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            <div class='row_of_details'>
                                <div class='head_of_details capital'><?php echo $lang['average_month'] . " " . $lang['income']; ?></div> 
                                <div class='body_of_details' id='month_income_content'><?php echo $decode -> money( ($exin_data[1] / 12) , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                            <div class='row_of_details imp_detail'>
                                <div class='head_of_details capital'><?php echo $lang['revenue']; ?></div> 
                                <div class='body_of_details' id='profit_content'><?php echo $decode -> money( ($exin_data[1] - $exin_data[0]) , $COUNTRY , $CURRENCY ); ?></div>
                            </div>
                        </div>
               </div>


 	    </div>

<?php 

            if($MODE == "mo2"){
                 $line_color = '#1C1E1E'; 
            }else{ 
                $line_color = '#e9e9e9'; 
            } 
            ?>

<script type="text/javascript">



//global configuration


//for font
Chart.defaults.global.defaultFontColor = "#ADADAD";
Chart.defaults.global.defaultFontFamily = "text-normal";
Chart.defaults.global.defaultFontSize = 12;
Chart.defaults.global.defaultFontStyle = "normal";

//for chart
Chart.defaults.global.responsive = true;
Chart.defaults.global.responsiveAnimationDuration = 500;
Chart.defaults.global.maintainAspectRatio = true;
Chart.defaults.global.events = ["mousemove", "mouseout", "click", "touchstart", "touchmove", "touchend"];
Chart.defaults.global.onClick = null;
Chart.defaults.global.legendCallback = null;
Chart.defaults.global.onResize = null;


var legend = {
    		display: true,
    		position: "bottom",
    		fullWidth: true,
    		//onClick: null,
    		//onHover: null,
    		labels: {
    				boxWidth: 10,
    				fontSize: 12,
    				fontStyle: "normal",
    				fontColor: "#6B6157",
    				fontFamily: "text-menu",
    				padding: 15,
    			},
    		reverse: false
    	};

var legend_2 = {
            display: false
        };

var layout = {
    			padding:00
    	};

var title = {
            display: false,
            position: 'top',
            fullWidth: true,
            fontSize: 14,
            fontFamily: "text-thin",
            fontColor: "#000000",
            fontStyle: "bold",
            padding: 20,
            text: '',
        };

var hover = {
    			mode: "point",
    			intersect: true,
    			animationDuration: 300,
    			onHover: null,//call the function
    	};

 var animation = {
    			duration: 600,
    			easing: "easeOutSine",
    			onProgress: null ,//function
    			onComplete: null //function 
    	};

  var scales = {
        	
            yAxes: [{
            	display: true,
            	drawBorder: true,
                ticks: {
                    beginAtZero:true,
                    display: true,
                    padding:15,
                    fontSize:11, 
                    fontColor:'#777777',
                    callback: function(label, index, labels) {
                        if(label > 1000){
                        	return "₹ " + label/1000 +'k';
                    	}else if(label < -1000){
                            return "₹ " + label/1000 +'k';
                        }else{

                    		return  Math.round( label * 10 ) / 10;
                    	}
                    }
               },
                gridLines: {
        			display: true,
        			color:"<?php echo $line_color; ?>",
        			drawBorder: false,
        			zeroLineColor: "<?php echo $line_color; ?>",
        		}
            }],

            xAxes: [{
            	display: true,
            	drawBorder: false,
            	 barPercentage: 0.7,
            	 ticks:{fontSize:10,
            	 	   fontColor:'#777777',
            	 },
				 gridLines: {
        			display: false,
        			color:"<?php echo $line_color; ?>",
        			drawBorder: false,
        			zeroLineColor: "<?php echo $line_color; ?>",

        		}

            }]
        };



    <?php 

    		$tip = "enabled: true,
    		mode: 'nearest',
    		intersect: true,
    		position: 'average', //nearest or average
    		backgroundColor: '#000',
    		titleFontFamily: 'text-thin',
    		titleFontSize: 12,
    		titleFontStyle: 'bold',
    		titleFontColor: '#fff',
    		titleSpacing: 0,
    		titleMarginBottom: 5,
    		bodyFontFamily: 'text-normal',
    		bodyFontSize: 13,
    		bodyFontStyle: 'normal',
    		bodyFontColor: '#f4f4f4',
    		bodySpacing: 0,
    		/*footerFontFamily: 'text-heading',
    		footerFontSize
			footerFontStyle
			footerFontColor
			footerSpacing
			footerMarginTop
    		*/
    		xPadding:20,
    		yPadding:10,
    		caretSize: 6,
    		cornerRadius: 6,
    		//multiKeyBackground: '#fff',
    		displayColors: false,";


        $colorset_1 = "[
                '#140F2D',
                '#F18F01',
                '#006E90',
                '#6D326D',
                '#F96668',
                '#DAEFB3',
                '#E59500',
                '#5F5449',
                '#3772FF',
                '#EDFF7A',
                '#C6AD94',
                '#392061',
                '#EA9E8D',
                '#85BDA6',
                '#D64550',
                '#E55812',  
                '#B0228C',
                '#EDFF7A',
                '#C6AD94',
                '#392061',
                '#EA9E8D',
                '#85BDA6',
                '#D64550',
                '#E55812',  
                '#B0228C',
                '#E8D33F',
                '#488B49',
                '#F49D37',
                '#BF1363',
                '#1C2826',
                '#F092DD',
                '#C5E063',
                '#D78521',
                '#E5DADA',
                '#003F91',              
                '#987284',
                '#D17B0F',
                '#F22B29',
                '#E5F4E3',
                '#F49D37',
                '#140F2D',
                '#F18F01',
                '#006E90',
                '#6D326D',
                '#A0E8AF',
                '#DAEFB3',
                '#E59500',
                '#5F5449',
                '#3772FF',
                '#EDFF7A',
                '#C6AD94',
                '#392061',
                '#EA9E8D',
                '#85BDA6',
                '#D64550',
                '#E55812',
                '#2F4B26',
                '#EF709D',
                '#EFE7DA',
                '#5DA9E9',


            ]";


              $colorset_2 = "[
                '#D78521',
                '#E5DADA',
                '#003F91',
                '#DAEFB3',
                '#E59500',
                '#5F5449',
                '#3772FF',
                '#EDFF7A',
                '#C6AD94',
                '#392061',
                '#EA9E8D',
                '#85BDA6',
                '#D64550',
                '#E55812',
                '#2F4B26',
                '#EF709D',
                '#EFE7DA',
                '#5DA9E9',
                '#987284',
                '#D17B0F',
                '#F22B29',
                '#E5F4E3',
                '#F49D37',
                '#140F2D',
                '#F18F01',
                '#006E90',
                '#6D326D',
                '#A0E8AF',
                '#B0228C',
                '#E8D33F',
                '#488B49',
                '#F49D37',
                '#BF1363',
                '#1C2826',
                '#F092DD',
                '#C5E063',

            ]";

    ?>




 function tip(type){
 		if(type == 'expense_income'){
 			return {
    				<?php echo $tip; ?>
    				callbacks: {
    			  			title: function(tooltipItem, data) {return data.labels[tooltipItem[0].index];},
                  			label: function(tooltipItem, data) {
                      		var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                      		value = value.toLocaleString('hi-<?php echo $LANGUAGE; ?>', { style: 'currency', currency: '<?php echo $CURRENCY; ?>' ,minimumFractionDigits: 2});
                      		return value;
                  			}
              			}

    			};
 		}
 		else if(type == 'cashflow'){
 				return {
 					<?php echo $tip; ?>
    				callbacks: {
    						  title: function(tooltipItem, data) {return data.labels[tooltipItem[0].index];},
                  			  label: function(tooltipItem, data) {
                  	  		  var label = data.datasets[tooltipItem.datasetIndex].label;
                      		  var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                      		  value = value.toLocaleString('hi-<?php echo $LANGUAGE; ?>', { style: 'currency', currency: '<?php echo $CURRENCY; ?>' ,minimumFractionDigits: 2});
                      		  return label + ": " + value;
                  			  }
             			 }
    		};

 		}
 }


var ctx_1 = document.getElementById("expense");
var ctx_2 = document.getElementById("income");
var ctx_3 = document.getElementById("sales");
var ctx_4 = document.getElementById("purchase");
var ctx_5 = document.getElementById("exin");



var expense = new Chart(ctx_1, {	
 		type: 'doughnut',
 		data: {
        labels: [ <?php echo $chart_expense_data[1]; ?> ],
        datasets: [{
            label: "<?php echo $lang['expense']; ?>",
            data: [<?php echo $chart_expense_data[2]; ?>],
            backgroundColor: <?php echo $colorset_1; ?>,
            borderColor: <?php echo $colorset_1; ?>,
            borderWidth: 0,
            hoverBorderWidth: 2
        }]
    },
    options: {hover: hover,
			  animation: animation,
			  legend: legend_2,
			  layout: layout,
			  title: title,
			  tooltips:tip('expense_income')

    }

 });


var income = new Chart(ctx_2, { 
        type: 'doughnut',
        data: {
        labels: [ <?php echo $chart_income_data[1]; ?>],
        datasets: [{
            label: "<?php echo $lang['income']; ?>",
            data: [<?php echo $chart_income_data[2]; ?>],
            backgroundColor: <?php echo $colorset_2; ?>,
            borderColor: <?php echo $colorset_2; ?>,
            borderWidth: 0,
            hoverBorderWidth: 2
        }]
    },
    options: {hover: hover,
              animation: animation,
              legend: legend_2,
              layout: layout,
              title: title,
              tooltips:tip('expense_income')

    }

 });


var sales_flow = new Chart(ctx_3, {
    type: 'bar',
    data: {
        labels:[<?php echo $period[4] ?>],
        datasets: [
         {
            type:"line",
            label: "<?php echo $lang['debit_note_received']; ?>",
            data: [ <?php echo $debit_note_monthly[0]; ?>],
            fill: false,
            borderDash: [3, 1],
            backgroundColor: "rgba( 230, 126, 34 ,0.3)",
            lineTension: 0.2,
            borderWidth:0,
            borderColor:'#DB3B73',
            pointRadius: 1.5,
            pointHitRadius:3,
            pointHoverRadius: 3,

            pointBorderColor: "#A82D58",
            pointBackgroundColor: "#A82D58",
            pointBorderWidth: 1,
            pointHoverBorderWidth: 2,

           /* pointHoverBackgroundColor: "#B5771B",
            pointHoverBorderColor: "#B5771B",*/
            
        },
        {
            type:"line",
            label: "<?php echo $lang['sales']; ?>",
            data: [ <?php echo $sale_monthly[0]; ?>],
            fill: false,
            backgroundColor: "rgba( 230, 126, 34 ,0.3)",
            lineTension: 0.2,
            borderWidth:0,
            borderColor:'#ef6036',
            pointRadius: 1.5,
            pointHitRadius:3,
            pointHoverRadius: 3,

            pointBorderColor: "#935016",
            pointBackgroundColor: "#935016",
            pointBorderWidth: 1,
            pointHoverBorderWidth: 2,

           /* pointHoverBackgroundColor: "#B5771B",
            pointHoverBorderColor: "#B5771B",*/
            
        },
       
        {
            type:'bar',
            label: "<?php echo $lang['payment_received']; ?>",
            data: [ <?php echo $payment_received_monthly[0]; ?>],  
            backgroundColor: "#399CF9",
            borderWidth : 0,
        }
        
        ] ,
        xLabels: [<?php echo $period[5] ?>] ,
        yLabels: [] ,
    },
    options: {
                hover: hover,
                animation: animation,
                legend: legend,
                layout: layout,
                scales: scales,
                title: title,
                tooltips:tip("cashflow"),
                scales: scales

    }
});

var purchase_flow = new Chart(ctx_4, {
    type: 'bar',
     data: {
        labels:[<?php echo $period[4] ?>],
        datasets: [
        {
            type:"line",
            label: "<?php echo $lang['debit_note_sent']; ?>",
            data: [ <?php echo $credit_note_monthly[0]; ?>],
            fill: false,
            borderDash: [3, 1],
            backgroundColor: "rgba( 230, 126, 34 ,0.3)",
            lineTension: 0.2,
            borderWidth:0,
            borderColor:'#C98936',
            pointRadius: 1.5,
            pointHitRadius:3,
            pointHoverRadius: 3,

            pointBorderColor: "#A5712C",
            pointBackgroundColor: "#A5712C",
            pointBorderWidth: 1,
            pointHoverBorderWidth: 2,

           /* pointHoverBackgroundColor: "#B5771B",
            pointHoverBorderColor: "#B5771B",*/
            
        },
        {
            type:"line",
            label: "<?php echo $lang['purchase']; ?>",
            data: [ <?php echo $purchase_monthly[0]; ?>],
            fill: false,
            backgroundColor: "rgba( 230, 126, 34 ,0.3)",
            lineTension: 0.2,
            borderWidth:0,
            borderColor:'#F4743B',
            pointRadius: 1.5,
            pointHitRadius:3,
            pointHoverRadius: 3,

            pointBorderColor: "#A84426",
            pointBackgroundColor: "#A84426",
            pointBorderWidth: 1,
            pointHoverBorderWidth: 2,

           /* pointHoverBackgroundColor: "#B5771B",
            pointHoverBorderColor: "#B5771B",*/
            
        },
        {
            type:'bar',
            label: "<?php echo $lang['payment_paid']; ?>",
            data: [ <?php echo $payment_paid_monthly[0]; ?>],  
            backgroundColor: "#F2C14E",
            borderWidth : 0,
        } 
        ] ,
        xLabels: [<?php echo $period[5] ?>] ,
        yLabels: [] ,
    },
    options: {
                hover: hover,
                animation: animation,
                legend: legend,
                layout: layout,
                scales: scales,
                title: title,
                tooltips:tip("cashflow"),
                scales: scales

    }
});


var exin_flow = new Chart(ctx_5, {
    type: 'line',
    data: {
        labels:[<?php echo $period[4] ?>],
        datasets: [{
            label: "<?php echo $lang['expense']; ?>",
            data: [<?php echo $chart_exin_data[0] ?> ],  
            fill: true,
            backgroundColor: "rgba( 239, 96, 54 , 0.3)",
             borderWidth : 0,
            lineTension: 0.2,
            borderColor:  '#ef6036',
              pointRadius: 1.5,
            pointHitRadius:3,
            pointHoverRadius: 3,

            pointBorderColor: "#993E23",
            pointBackgroundColor: "#993E23",
            pointBorderWidth: 1,
            pointHoverBorderWidth: 2,
        } , 
        {
            label: "<?php echo $lang['income']; ?>",
            data: [<?php echo $chart_exin_data[1] ?> ],
            fill: true,
            backgroundColor: "rgba(240, 56, 255 ,0.2)",
             borderWidth : 0,
            lineTension: 0.2,
            borderColor:'#F038FF',
            pointRadius: 1.5,
            pointHitRadius:3,
            pointHoverRadius: 3,

            pointBorderColor: "#9623A0",
            pointBackgroundColor: "#9623A0",
            pointBorderWidth: 1,
            pointHoverBorderWidth: 2,
            
        }
        ] ,
        xLabels: [<?php echo $period[5] ?>] ,
        yLabels: [] ,
    },
    options: {
                hover: hover,
                animation: animation,
                legend: legend,
                layout: layout,
                scales: scales,
                title: title,
                tooltips:tip("cashflow"),
                scales: scales

    }
});


</script>
<?php
/*
// Script end
function rutime($ru, $rus, $index) {
    return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
     -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
}

$ru = getrusage();
echo "This process used " . rutime($ru, $rustart, "utime") .
    " ms for its computations\n";
echo "It spent " . rutime($ru, $rustart, "stime") .
    " ms in system calls\n";


    $time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';

*/
?>

</body>
</html>
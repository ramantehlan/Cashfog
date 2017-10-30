<?php 



   function createPagination($query, $per_page = 10,$page = 1, $url = ''){
   global $db_name, $connect;   
       
        mysqli_select_db($connect ,$db_name);   
    	$query = "SELECT COUNT(*) as `num` FROM $query";

    	$row = mysqli_fetch_array(mysqli_query($connect , $query));
    	$total = $row['num'];
        $adjacents = "3"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;

    	$no_div = "<div class='pagination_box_item pagination_page_no'>";
    	$no_div_1 = "<div class='pagination_box_item pagination_page_no pagination_selected'>";
    	$no_div_2 = "<div class='pagination_box_item pagination_button pagination_button_right'>";
    	$no_div_3 = "<div class='pagination_box_item pagination_button pagination_button_left'>";
    	$no_div_4 = "<div class='pagination_box_item pagination_dots'>";
    	
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<div class='pagination_box'>";

            $pagination .= "<div class='pagination_details' >Page $page of $lastpage</div>";
    		$pagination.= "<a href='{$url}$prev'>$no_div_3 Previous</div></a>";
    		$pagination .= "<div class='pagination_center'>";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<a class='current'>$no_div_1 $counter</div></a>";
    				else
    					$pagination.= "<a href='{$url}$counter'>$no_div $counter</div></a>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<a class='current'>$no_div_1 $counter</div></a>";
    					else
    						$pagination.= "<a href='{$url}$counter'>$no_div $counter</div></a>";					
    				}
    				$pagination.= "$no_div_4 ...</div>";
    				$pagination.= "<a href='{$url}$lpm1'>$no_div $lpm1</div></a>";
    				$pagination.= "<a href='{$url}$lastpage'>$no_div $lastpage</div></a>";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<a href='{$url}1'>$no_div 1</div></a>";
    				$pagination.= "<a href='{$url}2'>$no_div 2</div></a>";
    				$pagination.= "$no_div_4 ...</div>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<a class='current'>$no_div_1 $counter</div></a>";
    					else
    						$pagination.= "<a href='{$url}$counter'>$no_div $counter</div></a>";					
    				}
    				$pagination.= "$no_div_4 ...</div>";
    				$pagination.= "<a href='{$url}$lpm1'>$no_div $lpm1</div></a>";
    				$pagination.= "<a href='{$url}$lastpage'>$no_div $lastpage</div></a>";		
    			}
    			else
    			{
    				$pagination.= "<a href='{$url}1'>$no_div 1</div></a>";
    				$pagination.= "<a href='{$url}2'>$no_div 2</div></a>";
    				$pagination.= "$no_div_4 ...</div>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<a class='current'>$no_div_1 $counter</div></a>";
    					else
    						$pagination.= "<a href='{$url}$counter'>$no_div $counter</div></a>";					
    				}
    			}
    		}
    		
    			$pagination.= "</div>";
    			$pagination.= "<a href='{$url}$next'>$no_div_2 Next</div></a>";
                //$pagination.= "<a href='{$url}$lastpage'>$no_div_2 Last</div></a>";

    		$pagination.= "</div>\n";		
    	}
    
    
        return $pagination;
    } 
?>
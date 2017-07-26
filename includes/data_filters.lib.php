<?php
/************************************************
Data_filters library is to apply fiters to make data 
simple

creator:- raman tehlan
date of creation:- 21/11/2016
**************************************************/

class data_filters
{

/**********************************************
This is to calculate difference between two dates 
in days
***********************************************/

    public function date_difference($date_1 , $date_2){
            $starting_date  = strtotime($date_1);
            $ending_date    = strtotime($date_2);
            $diff         = (abs($starting_date - $ending_date) )/(60*60*24);

            return $diff;
    }

/***********************************************
      this is to calculate the time of update 
      and make it in ago format
***********************************************/



    public function round_date($time)
       {
    
            $last_date    = strtotime($time);
            $current_date = strtotime(date('20y-m-d h:i:s'));
            $diff         = abs($current_date - $last_date);

            $seconds  = floor($diff/1);
            $minutes  = floor($diff/(60));
            $hours    = floor($diff/(60*60));
            $days     = floor($diff/(60*60*24));
            $week     = floor($diff/(60*60*24*7));
            $month    = floor($diff/(60*60*24*30));
            $years    = floor($diff/(365*24*60*60));
            
            $result = "updated";

             if($years >= 1)
             {$result = "$years year ago";}
           
             else if($month >= 1)
             {$result = "$month month ago";}

             else if($week >= 1)
             {$result = "$week week ago";}

             else if($days >= 1)
             {$result = "$days day ago";}
            
             else if($hours >= 1)
             {$result = "$hours hours ago";}
            
             else if($minutes >= 1)
             {$result = "$minutes minutes ago";}
             
             else
             {$result = "$seconds seconds ago";}

             return $result;

            unset($last_date);
            unset($current_date);
            unset($diff);
            unset($seconds);
            unset($minutes);
            unset($hours);
            unset($days);
            unset($week);
            unset($month);
            unset($years);
            unset($result);


           }




/***********************************************
round the numbers
***********************************************/


           public function round_no($no)
           {
              $result = $no;

                    if($no < 1000)
                    {
                       $result = $no;
                    }
                    else if($no >= 1000)
                    {
                      $no     = floor($no/1000);
                      $result = $no . "K";
                    }

                    return $result;

            unset($result);

           }



}

?>
<?php
ob_start();
//default_time_zone

 $url = 'http://ip-api.com/json/'.$_SERVER["REMOTE_ADDR"];  //include API url for detection of isp,region,country of an ip
 $obj = json_decode(file_get_contents($url), true); //converting json data into PHP 
 if (isset($obj['timezone'])) {

    $_SESSION['USER_TIME_ZONE'] = $obj['timezone'];
    //default_time_zone
    date_default_timezone_set($_SESSION['USER_TIME_ZONE']);
   //current date_time
    $current_date =date('Y-m-d H:i:s');
     
   }
   else
   {
     echo "Cannot start important headers.";
   }
  

 
 

$con = mysqli_connect("localhost","root","","ppt");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }
 
 //fb time ago
 
         function get_time_ago( $time )     //converting nornal time into facebook time ago
        {
            $time_difference = time() - $time;
        
            if( $time_difference < 1 ) { return 'less than 1 second ago'; }
            $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                        30 * 24 * 60 * 60       =>  'month',
                        24 * 60 * 60            =>  'day',
                        60 * 60                 =>  'hr',
                        60                      =>  'min',
                        1                       =>  'sec'
            );
        
            foreach( $condition as $secs => $str )
            {
                $d = $time_difference / $secs;
        
                if( $d >= 1 )
                {
                    $t = round( $d );
                    return  $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
                }
            }
        }
   

?>
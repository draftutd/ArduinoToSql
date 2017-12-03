<?php
   require_once("config.php");
   $sensortwo = $_GET['sensortwo'];
   $datecheck = $_GET['datecheck'];
date_default_timezone_set("Asia/Bangkok");

$date_array = getdate();

$format_date .= $date_array['mday']."/";
$format_date .= $date_array['mon']."/";
$format_date .= $date_array['year'];

$format_time .= $date_array['hours'].":";
$format_time .= $date_array['minutes'].":";
$format_time .= $date_array['seconds'];

$format_check .= (int)((($datecheck % 86400) / 3600)+7) .":";
if((($datecheck % 3600)/60)<10){
$format_check .= "0";
}
$format_check .= (int)(($datecheck % 3600) / 60).":";
if(($datecheck % 60)<10){
$format_check .= "0";
}
$format_check .= (int)$datecheck % 60;

print $format_date.'-----'.$format_time;
print '  Data = '. $sensortwo;
$sql = "INSERT INTO sensortwo (Datecheck,Sensordatatwo,Date,Time) VALUES ('$format_check','$sensortwo','$format_date','$format_time')";
$sql_query = mysql_query($sql);
if ($sql_query) {
    echo " Complete";
} else {
    echo "Error";
}
?>
<?php
   require_once("config.php");
$temp = $_GET['temp'];

date_default_timezone_set("Asia/Bangkok");

$date_array = getdate();

$format_date .= $date_array['mday']."/";
$format_date .= $date_array['mon']."/";
$format_date .= $date_array['year'];

$format_time .= $date_array['hours'].":";
$format_time .= $date_array['minutes'].":";
$format_time .= $date_array['seconds'];

print $format_date.'-----'.$format_time;

//$sql1 = "INSERT INTO temp SET Temp = '$temp' ";
//$sql2 = "INSERT INTO temp SET Date = '$format_date' ";
//$sql3 = "INSERT INTO temp SET Time = '$format_time' ";
$sql = "INSERT INTO TEMP (Temp,Date,Time) VALUES ('$temp','$format_date','$format_time')";
$sql_query = mysql_query($sql);
if ($sql_query) {
    echo "Complete";
} else {
    echo "Error";
}
?>

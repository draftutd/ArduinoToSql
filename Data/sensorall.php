<?php
session_start();
?>
<?php
   require_once("config.php");

$sensorone =  $_SESSION["sensorone"];
$sensortwo = $_SESSION["sensortwo"];
$sensorthree = $_SESSION["sensorthree"];



print $format_date.'-----'.$format_time;
print '  Data1 = '. $sensorone;
print '  Data2 = '. $sensortwo;
print '  Data3 = '. $sensorthree;
$sql = "INSERT INTO sensorall (Datathree,Datatwo,Dataone,Date,Time,allDate) VALUES ('$sensorthree','$sensortwo','$sensorone','$format_date','$format_time','$format_date $format_time')";
$sql_query = mysql_query($sql);
if ($sql_query) {
    echo " Complete";
} else {
    echo "Error";
}
?>
<!DOCTYPE html >
<?php
include 'connect.php';
?>
<html ><head>
<meta http-equiv="refresh" content="1"/ name="viewport" content="width=device-width, initial-scale=1" http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>    
<title>Index</title>
<?PHP
$objDB = mysql_select_db("datasensor"); 
$total_data1 = mysql_num_rows(mysql_query("SELECT * FROM sensorone"));
$start_1 = $total_data1-30;
$total_data2 = mysql_num_rows(mysql_query("SELECT * FROM sensortwo"));
$start_2 = $total_data2-30;
$total_data3 = mysql_num_rows(mysql_query("SELECT * FROM sensorthree"));
$start_3 = $total_data3-30;
$objQuerychart1 = mysql_query("SELECT * FROM sensorone LIMIT $start_1,30");
$objQuerychart2 = mysql_query("SELECT * FROM sensortwo LIMIT $start_2,30");
$objQuerychart3 = mysql_query("SELECT * FROM sensorthree LIMIT $start_3,30");        
?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    google.load('visualization', '1.0', {'packages':['corechart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'เวลา');
        data.addColumn('number', 'สถานีไฟฟ้า 1');
		<? $max1 =0; $min1 = 100000;
		for ( $i = 0; $i < $total_data1 ; $i++) {
			while($rowCharts1 = mysql_fetch_array($objQuerychart1)) {
				$max1 = $max1 > $rowCharts1["Sensordataone"] ? $max1 : $rowCharts1["Sensordataone"];
				$mean1 = $rowCharts1["Sensordataone"];
				$min1 = $min1 < $rowCharts1["Sensordataone"] ? $min1 : $rowCharts1["Sensordataone"];
				?>
         data.addRow(['<?=$rowCharts1["Time"]?>',<?=$rowCharts1["Sensordataone"]?>]);
		<? }}?>



        // Set chart options
     
       
 // Set chart options 2
        var options = {
                       'width':1450,
                       'height':200,
					   'is3D': 'true'
};


        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);

      }
    </script>
    
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1.0', {'packages':['corechart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'เวลา');
        data.addColumn('number', 'สถานีไฟฟ้า 2');
		<? $max2 = 0; $min2=100000;
		for ( $i = 0; $i < $total_data2 ; $i++) {
			while($rowCharts2 = mysql_fetch_array($objQuerychart2)) {
				$max2 = $max2 > $rowCharts2["Sensordatatwo"] ? $max2 : $rowCharts2["Sensordatatwo"];
				$mean2 = $rowCharts2["Sensordatatwo"];
				$min2 = $min2 < $rowCharts2["Sensordatatwo"] ? $min2 : $rowCharts2["Sensordatatwo"];
				?>
         data.addRow(['<?=$rowCharts2["Time"]?>',<?=$rowCharts2["Sensordatatwo"]?>]);
		<? }}?>



        // Set chart options
     
       
 // Set chart options 2
        var options = {
                       'width':1450,
                       'height':200,
					   'is3D': 'true'
};


        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
        chart.draw(data, options);

      }
    </script>
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    google.load('visualization', '1.0', {'packages':['corechart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'เวลา');
        data.addColumn('number', 'สถานีไฟฟ้า 3');
		<? $max3 = 0; $min3 = 100000;
		for ( $i = 0; $i < $total_data3 ; $i++) {
			while($rowCharts3 = mysql_fetch_array($objQuerychart3)) {
				$max3 = $max3 > $rowCharts3["Sensordatathree"] ? $max3 : $rowCharts3["Sensordatathree"];
				$mean3 = $rowCharts3["Sensordatathree"];
				$min3 = $min3 < $rowCharts3["Sensordatathree"] ? $min3 : $rowCharts3["Sensordatathree"];
				?>
         data.addRow(['<?=$rowCharts3["Time"]?>',<?=$rowCharts3["Sensordatathree"]?>]);
		<? }}?>



        // Set chart options
     
       
 // Set chart options 2
        var options = {
                       'width':1450,
                       'height':200,
					   'is3D': 'true'
					   
};


        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
        chart.draw(data, options);

      }
    </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<div class="container">
  <div class="btn-group btn-group-justified">
     <a href="index.php?Page=1" class="btn btn-info">Home</a>
   <a href="Sensorone.php?Page=1" class="btn btn-info">สถานีไฟฟ้า 1</a>
    <a href="sensortwo.php?Page=1" class="btn btn-info">สถานีไฟฟ้า 2</a>
    <a href="Sensorthree.php?Page=1" class="btn btn-info">สถานีไฟฟ้า 3</a>
    <a href="exportreport.php" class="btn btn-info">ออกรายงาน</a>
  </div>
</div>
 
<center><h1>กราฟแสดงผลการบันทึกค่าการตรวจจับเซนเซอร์</h1><div id="chart_div" style="height: 100%; width: 100%;"></div></center>
<center><div id="chart_div2" style="height: 100%; width: 100%;"></div></center>
<center><div id="chart_div3" style="height: 100%; width: 100%;"></div></center>

<div class="container" >
<div class="table table-striped" > <br> 
  <table width="45" height="45" class="table table-striped">
    <thead>
      <tr>
        <th width="10%"></th>
        <th width="30%"><center>สถานีไฟฟ้า 1</center></th>
        <th width="30%"><center>สถานีไฟฟ้า 2</center></th>
        <th width="30%"><center>สถานีไฟฟ้า 3</center></th>
      </tr>
    </thead>
    
     <tbody>
	 	<tr>
        <td><center><font color="#FF0000">ค่าสูงสุง</font></center></td>
		  <td><center><font color="#FF0000"><? echo $max1?></font></center></td>
		   <td><center><font color="#FF0000"><? echo $max2?></font></center></td>
		  <td><center><font color="#FF0000"><? echo $max3?></font></center></td>	
        </tr>
        <tr>
        <td><center><font color="#990099">ค่าปัจจุบัน</font></center></td>
		  <td><center><font color="#990099"><? echo $mean1?></font></center></td>
		   <td><center><font color="#990099"><? echo $mean2?></font></center></td>
		  <td><center><font color="#990099"><? echo $mean3?></font></center></td>	
        </tr>
        <tr>
        <td><center><font color="#0000FF">ค่าต่ำสุด</font></center></td>
		  <td><center><font color="#0000FF"><? echo $min1?></font></center></td>
		   <td><center><font color="#0000FF"><? echo $min2?></font></center></td>
		  <td><center><font color="#0000FF"><? echo $min3?></font></center></td>	
        </tr>
    </tbody>
  </table>
</div>
</div>
</body>
</html>

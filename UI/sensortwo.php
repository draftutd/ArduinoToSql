<!DOCTYPE html >
<?php
include 'connect.php';
?>
<html ><head>
<meta name="viewport" content="width=device-width, initial-scale=1" http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>    
<title>Sensortwo</title>
<?PHP
$page = $_GET['Page'];
$rows=60;
$total_data = mysql_num_rows(mysql_query("SELECT * FROM sensortwo"));
$total_page=ceil($total_data/$rows);
$start=(($page-1)*$rows); 
$objQuery = mysql_query("SELECT * FROM sensortwo LIMIT $start,60") or die ("Error Query [SELECTFROM sensortwo]");
$objQuerychart = mysql_query("SELECT * FROM sensortwo ");
		  
        
?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    google.load('visualization', '1.0', {'packages':['corechart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'เวลา');
        data.addColumn('number', 'ค่าที่อ่านได้/เวลา');
		<? for ( $i = 0; $i < $total_data ; $i++) {
			while($rowCharts = mysql_fetch_array($objQuerychart)) {
				?>
         data.addRow(['<?=$rowCharts["Time"]?>',<?=$rowCharts["Sensordatatwo"]?>]);
		<? }}?>



        // Set chart options
     
       
 // Set chart options 2
        var options = {
                       'width':1450,
                       'height':300,
					   'is3D': 'true'
};


        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
var chart = new google.visualization. Column(document.getElementById('chart_div2'));
        chart.draw(data, options);

      }
    </script>
</head>

<body>
<div class="container">
  <div class="btn-group btn-group-justified">
   <a href="index.php?Page=1" class="btn btn-info">Home</a>
   <a href="Sensorone.php?Page=1" class="btn btn-info">สถานีไฟฟ้า 1</a>
    <a href="sensortwo.php?Page=1" class="btn btn-info">สถานีไฟฟ้า 2</a>
    <a href="Sensorthree.php?Page=1" class="btn btn-info">สถานีไฟฟ้า 3</a>
  </div>
</div>
 
<center><h1>กราฟแสดงผลการบันทึกค่าการตรวจจับเซนเซอร์ตัวที่สอง</h1><div id="chart_div" style="height: 300px; width: 100%;"></div></center>




<div class="container" >
  <h2>ตารางแสดงค่า</h2>
                                                                                        
       <div class="table table-striped" >  
  <table width="89%" height="45" class="table table-striped">
    <thead>
      <tr>
        <th width="10%"><center>ลำดับ</center></th>
        <th width="20%"><center>วันที่</center></th>
        <th width="20%"><center>เวลา</center></th>
        <th width="50%"><center>ข้อมูลการอ่านค่าเซนเซอร์</center></th>
      </tr>
    </thead>
    
     <tbody>
     <?php	 
     while($row = mysql_fetch_array($objQuery))
 {
	 	 echo "<tr>";
         echo "<td><center>" .$row["ID"] .  "</center></td> ";
		  echo "<td><center>" .$row["Date"] .  "</center></td> ";
		   echo "<td><center>" .$row["Time"] .  "</center></td> ";
		   echo "<td><center>" .$row["Sensordatatwo"] .  "</center></td> ";
			
      echo "</tr>";}
	  ?>
    </tbody>
  </table>
  
 <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li <? if($page==1){echo 'class="disabled"';}?>>
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <? for($i=1;$i<=$total_page;$i++){?>
    <li <? if($page==$i){echo 'class="active"';}else {echo 'class="page-item"';}?>><a class="page-link" href="sensortwo.php?Page=<?=$i?>"><?=$i?></a></li>
    <?}?>
    <li <? if($page==$total_page){echo 'class="disabled"';}?>
      //<a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
  
  </div>
</div>
</body>
</html>

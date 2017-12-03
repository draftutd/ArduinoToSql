<!DOCTYPE html >
<html >
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>TABLE PAGE</title>
</head>

<body>


<div class="container">
  <h2>ตารางแสดงค่า</h2>
                                                                                        
  <div class="table table-striped">          
  <table width="89%" height="45" class="table table-striped">
    <thead>
      <tr>
        <th width="10%"><center>ลำดับ</center></th>
        <th width="20%"><center>วันที่</center></th>
        <th width="20%"><center>เวลา</center></th>
        <th width="50%"><center>Sensor 1</center></th>
      </tr>
    </thead>
    
     <tbody>
     <?php
	$objConnect = mysql_connect("localhost","root","password") or die("Error Connect to Database");
$objDB = mysql_select_db("datasensor");
$objQuery = mysql_query("SELECT * FROM sensorone ") or die ("Error Query [SELECTFROM sensorone]");

     while($row = mysql_fetch_array($objQuery))
 {
	 	 echo "<tr>";
         echo "<td><center>" .$row["ID"] .  "</center></td> ";
		  echo "<td><center>" .$row["Date"] .  "</center></td> ";
		   echo "<td><center>" .$row["Time"] .  "</center></td> ";
		   echo "<td><center>" .$row["Sensordataone"] .  "</center></td> ";
			
      echo "</tr>";}
	  ?>
    </tbody>
    
    
  </table>
  
  </div>
</div>
</body>
</html>

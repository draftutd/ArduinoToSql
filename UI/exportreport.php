<?php

include 'connect.php';
/** Error reporting */
error_reporting(E_ALL);

date_default_timezone_set('Asia/Bangkok');

/** PHPExcel */
require_once 'PHPExcel/Classes/PHPExcel.php';


// Create new PHPExcel object
//echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
//echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$date_array = getdate();
// Add some data
//echo date('H:i:s') . " Add some data\n";
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'ข้อมูลอัพเดทล่าสุด ณ '.date('d/m/Y H:i:s'))
            ->setCellValue('A2', 'ลำดับ')
            ->setCellValue('B2', 'วันที่')
            ->setCellValue('C2', 'เวลา')
			->setCellValue('D2', 'ข้อมูลการอ่านค่าเซ็นเซอร์หนึ่ง')
			->setCellValue('H2', 'ลำดับ')
            ->setCellValue('I2', 'วันที่')
            ->setCellValue('J2', 'เวลา')
			->setCellValue('K2', 'ข้อมูลการอ่านค่าเซ็นเซอร์สอง')
			->setCellValue('O2', 'ลำดับ')
            ->setCellValue('P2', 'วันที่')
            ->setCellValue('Q2', 'เวลา')
			->setCellValue('R2', 'ข้อมูลการอ่านค่าเซ็นเซอร์สาม')
			;

// Write data from MySQL result
$objDB = mysql_select_db("datasensor");
$strSQL1 = "SELECT * FROM sensorone";
$objQuery1 = mysql_query($strSQL1);
$i = 3;
while($objResult1 = mysql_fetch_array($objQuery1))
{
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $objResult1["ID"]);
	$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $objResult1["Date"]);
	$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $objResult1["Time"]);
	$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $objResult1["Sensordataone"]);
	$i++;
}

$strSQL2 = "SELECT * FROM sensortwo";
$objQuery2 = mysql_query($strSQL2);
$i = 3;
while($objResult2 = mysql_fetch_array($objQuery2))
{
	$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $objResult2["ID"]);
	$objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $objResult2["Date"]);
	$objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $objResult2["Time"]);
	$objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $objResult2["Sensordatatwo"]);
	$i++;
}

$strSQL3 = "SELECT * FROM sensorthree";
$objQuery3 = mysql_query($strSQL3);
$i = 3;
while($objResult3 = mysql_fetch_array($objQuery3))
{
	$objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $objResult3["ID"]);
	$objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $objResult3["Date"]);
	$objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $objResult3["Time"]);
	$objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $objResult3["Sensordatathree"]);
	$i++;
}

// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('ReportData');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$strData = "ReportData".date('d_m_Y H_i_s');
$strFileName = "C:\\Users\\Peerapong\\Desktop\\$strData.xlsx";
$objWriter->save($strFileName);


// Echo memory peak usage
//echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";
echo "<center><h1> ออกรายงานสำเร็จ โปรดตรวจสอบที่ Desktop ไฟล์เอกสารชื่อ $strData.xlsx </h1></center>";
echo "<center><h2>ณ เวลา ".date('d/m/Y H:i:s')."</h1></center>";
?>
<html lang="en">
<head>
  <title>ออกรายงาน</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="btn-group btn-group-justified">
    <center><a href="index.php" class="btn btn-primary">กลับหน้าแรก</a></center>
  </div>
</div>


</body>
</html>

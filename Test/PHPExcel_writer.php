<?php

include 'connect.php';
/** Error reporting */
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once 'PHPExcel/Classes/PHPExcel.php';


// Create new PHPExcel object
echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
echo date('H:i:s') . " Add some data\n";
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ลำดับ')
            ->setCellValue('B1', 'วันที่')
            ->setCellValue('C1', 'เวลา')
			->setCellValue('D1', 'ข้อมูลการอ่านค่า')
			;

// Write data from MySQL result
$objDB = mysql_select_db("datasensor");
$strSQL = "SELECT * FROM sensorone";
$objQuery = mysql_query($strSQL);
$i = 2;
while($objResult = mysql_fetch_array($objQuery))
{
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $objResult["ID"]);
	$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $objResult["Date"]);
	$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $objResult["Time"]);
	$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $objResult["Sensordataone"]);
	$i++;
}

// Rename sheet
echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('My Customer');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$strFileName = "myData.xlsx";
$objWriter->save($strFileName);


// Echo memory peak usage
echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";

// Echo done
echo date('H:i:s') . " Done writing file.\r\n";
?>
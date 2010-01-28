<?php
	require 'lib.php';
	include 'lib/PHPExcel.php';
	include 'lib/PHPExcel/Writer/Excel2007.php';
	include 'lib/PHPExcel/IOFactory.php';
	
	$db = connectToDB();
	
	$query = $db->prepare('SELECT name, email, phone FROM person');
	$query->execute();
	$query->bind_result($name, $email, $phone);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename=registrations.xlsx');
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setTitle("Jain Foundation registrants");
	$objPHPExcel->setActiveSheetIndex(0);
	
	$row = 1;
	
	// Print headers
	$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(0, $row, "Name");
	$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(1, $row, "Email");
	$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(2, $row, "Phone");
	$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
	$row++;
	
	// Print data
	while ($query->fetch()) {
		// This assumes the phone is stored as 10 pure digits. TODO: validate it.
		$phone = preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '(\1) \2-\3', $phone);
		
		// Format the data into the spreadsheet
		$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(0, $row, $name);
		$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(1, $row, $email);
		$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(2, $row, $phone);

		$row++;
	}
	$query->close();
	
	// Send the spreadsheet to the browser
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
?>

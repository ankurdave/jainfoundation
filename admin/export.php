<?	session_start();	if(isset($_SESSION['SESSION_ID'])){		$login = true;	}else{		session_destroy();		$login=false;		include "login.php";		exit;	}?><?include('includes/mysql.php');

$select = "SELECT * FROM registrants order by patient_id desc";$export = mysql_query($select);$fields = mysql_num_fields($export); 

// Print the HTTP headers
header("Content-Type: text/csv");header("Content-Disposition: attachment; filename=patient-data.csv");

while($row = mysql_fetch_row($export)) {    $line = '';    foreach($row as $value) {                                                    if ((!isset($value)) OR ($value == "")) {            $value = "\t";        } else {
            $value = str_replace('"', '""', $value);            $value = '"' . $value . '"' . "\t";        }        $line .= $value;    }    $data .= trim($line)."\n";}$data = str_replace("\r","",$data); if ($data == "") {    $data = "\n(0) Records Found!\n";                        } $csv = "$header\n$data"; //base64_decode(#HTTP_POST_VARS["csv_data"]) ;header("Expires: Mon, 26 Jul 1997 05:00:00 GMT") ;header("Pragma: no-cahce") ;header("Content-Type: application/vnd.ms-excel");header("Content-Disposition: attachment; filename=".uniqid('').'.xls');header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0,pre-check=0");header("Content-Type: application/vnd.ms-excel");header("Content-Disposition: \"inline\"");header("Content-Length: " . strlen($csv));echo $csv ;//@readfile("$header\n$data");?>
?>

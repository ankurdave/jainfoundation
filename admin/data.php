<?php

session_start();
if (isset($_SESSION['SESSION_ID'])) {
	$login = true;
} else {
	session_destroy();
	$login=false;
	include "login.php";
	exit;
}

include("includes/mysql.php");

$sql = "SELECT patient_id, submission_date,first_name, last_name, email, address, city_state_zip, country, phone, age,  diagnosis_age , diagnosis_examination, diagnosis_CK_level, diagonsis_muscle_biopsy, diagnosis_blood_cell_test, diagnosis_mutational from registrants order by patient_id desc";

$rs=mysql_query($sql);

if (!$rs) {
	die('Error:' . mysql_error());
}
$rows = mysql_num_rows($rs);
$row = 1;

if ($_REQUEST["action"] == "delete") {
	$sql = "DELETE FROM registrants WHERE patient_id={$_REQUEST['patient_id']}";
	$rs = mysql_query($sql);
?>
	<script language="javascript">
		window.location="data.php";
	</script>
<?php
}

if ($_REQUEST["action"] == "confirm") {
?>
	<form name="DeletePatient" method="post" action="data.php">
		<input type="hidden" name="patient_id" value="<?=$_GET["patient_id"] ?>">
		<input type="hidden" name="action" value="delete">
		<table width="95%" border="0" cellpadding="2" cellspacing="1" align="center">
			<tr>
				<td align="center">
					<strong><?= "Confirm Delete" ?></strong>
				</td>
			</tr>
			<tr>
				<td align="center">
					Are you sure you want to delete <BR /><strong><?=$_GET["name"] ?></strong>?
				</td>
			</tr>
			<tr>
				<td align="center">
					<input type="submit" name="Status" value="Yes">
					<font id="Medium">
						&nbsp;</font>
					<input type="button" name="Status" value="No" onClick="window.location='data.php';">
				</td>
			</tr>
		</table>
	</form>
<?php
}
?>

<html>
	<head>
		<title>Jain Foundation Inc | Patient Registration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<LINK REL="stylesheet" TYPE="text/css" HREF="style.css">
	</head>
	<body leftmargin="10" topmargin="10" marginwidth="10" marginheight="10">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center">
					<table width="1200" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
						<tr>
							<td height="80" width="22%" valign="middle">
								&nbsp;&nbsp;<img src="images/logo_admin.jpg" width="211" height="50">
							</td>
							<td align="left">
								<p>
									<a href="logout.php">
										<strong>Logout</strong>
									</a>
									<strong>
										<br>
										<a href="export.php">Export List</a>
									</strong>
								</p>
							</td>
							<td width="1%" align="right">
								&nbsp;</td>
						</tr>
						<tr>
							<td height="40">
								<font color="#990000">
									&nbsp;&nbsp;<strong>List of Registered Patients</strong>
								</font>
							</td>
							<td align="right">
								&nbsp;</td>
							<td align="right">
								&nbsp;</td>
						</tr>
					</table>
<?php
if (!mysql_num_rows($rs) > 0) {
?>
					<div align="center">
						<br />
						<strong>There are no Registered Patients.</strong>
					</div>
					<?php
} else {
?>
<table width="1200" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF" Class="data">
	<tr bgcolor="#333333">
		<td width="13%" height="25">
			<p class="data">
				<font color="#FFFFFF">
					<strong>
						&nbsp;Name</strong>
				</font>
			</p>
		</td>
		<td width="8%" align="center" nowrap>
			<p class="data">
				<font color="#FFFFFF">
					<strong>
						Submission Date</strong>
				</font>
			</p>
		</td>
		<td width="22%" align="center">
			<p class="data">
				<font color="#FFFFFF">
					<strong>
						Address</strong>
				</font>
			</p>
		</td>
		<td width="9%" align="center">
			<p class="data">
				<font color="#FFFFFF">
					<strong>
						Phone</strong>
				</font>
			</p>
		</td>
		<td width="16%" align="center">
			<p class="data">
				<font color="#FFFFFF">
					<strong>
						Email</strong>
				</font>
			</p>
		</td>
		<td width="4%" align="center">
			<p class="data">
				<font color="#FFFFFF">
					<strong>
						Current Age</strong>
				</font>
			</p>
		</td>
		<td width="6%" align="center">
			<p class="data">
				<font color="#FFFFFF">
					<strong>
						Diagnosis Age</strong>
				</font>
			</p>
		</td>
		<td width="15%" align="center">
			<p class="data">
				<font color="#FFFFFF">
					<strong>
						How Diagnosis Was Made</strong>
				</font>
			</p>
		</td>
		<td width="7%" align="center">
			<p class="data">
				<font color="#FFFFFF">
					<strong>
						Action</strong>
				</font>
			</p>
		</td>
	</tr>
	<?php
		 while($data = @mysql_fetch_array($rs, MYSQL_ASSOC) ) {
				  $FullName = $data["first_name"] . " " . $data["last_name"];
				  if (empty($data["address"])) {
				  $address = $data["address"];
				  }else{
				  $address = $data["address"] . ",";
				  }
				  ?>
	<tr>
		<td height="25">
			<p class="data">
				<?=$FullName; ?>
			</p>
		</td>
		<td height="25">
			<p class="data">
				<?=$data["submission_date"];?>
			</p>
		</td>
		<td align="left">
			<p class="data">
				<?=$address; ?>
				<?=$data["city_state_zip"];?>
				, <?=$data["country"];?>
			</p>
		</td>
		<td align="center">
			<p class="data">
				<?=$data["phone"];?>
			</p>
		</td>
		<td align="center">
			<p class="data">
				<?=$data["email"];?>
			</p>
		</td>
		<td align="center">
			<p class="data">
				<?=$data["age"];?>
			</p>
		</td>
		<td align="center">
			<p class="data">
				<?=$data["diagnosis_age"];?>
			</p>
		</td>
		<td align="left">
			<p class="data">
		 		Physical examination:<strong>
					<?=$data["diagnosis_examination"];?>
				</strong>
				<br>
		 		CK (creatine kinase) level: <strong>
					<?=$data["diagnosis_CK_level"];?>
				</strong>
				<br>
				Muscle biopsy: <strong>
					<?=$data["diagonsis_muscle_biopsy"];?>
				</strong>
				<br>
				Blood cell (monocyte) test:<strong>
					<?=$data["diagnosis_blood_cell_test"];?>
				</strong>
				<br>
				Mutational analysis: <strong>
					<?=$data["diagnosis_mutational"];?>
				</strong>
				<br>
			</p>
		</td>
		<td align="center">
			<p class="data">
				<a href="data.php?action=confirm&patient_id=<?=$data["patient_id"]?>
																				 &name=<?=$FullName?>
																				 " class="data">
					delete</a>
			</p>
		</td>
	</tr>
	<?php
		 }
		 ?>
</table>
<?php
	 }
	 ?>
</td>
</tr>
</table>
</body>
</html>


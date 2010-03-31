<? 
session_start();

if(isset($_SESSION['SESSION_AGREE'])){

		include('includes/mysql.php');
		include('includes/fixvars.php');
		include('includes/countries.php');
		$myDate = date("Y/m/d");
	}else{
		session_destroy();
		$login=false;
		include "register.php";
		exit;
	}
?>

<?

if(@$_REQUEST["action"]=="save")

{



$sql="INSERT INTO registrants " .

		"(first_name, last_name, email, phone, address, city_state_zip, " .

		"country, gender, age, diagnosis_age, diagnosis_examination, diagnosis_CK_level, diagnosis_CK_level_number, " .

		"diagonsis_muscle_biopsy, diagnosis_blood_cell_test, diagnosis_mutational, submission_date " .

		") values (" .

		"'{$_REQUEST['firstName']}', " .

		"'{$_REQUEST[lastName]}', " .

		"'{$_REQUEST[email]}', " .

		"'{$_REQUEST[phone]}', " .

		"'{$_REQUEST[address]}', " .

		"'{$_REQUEST[cityStateZip]}', " .

		"'{$_REQUEST[country]}', " .

		"'{$_REQUEST[gender]}', " .

		"'{$_REQUEST[currentAge]}', " .

		"'{$_REQUEST[diagnosisAge]}', " .

		"'{$_REQUEST[diagnosis_examination]}', " .

		"'{$_REQUEST[diagnosis_CK_level]}', " .

		"'{$_REQUEST[diagnosis_CK_level_number]}', " .

		"'{$_REQUEST[diagonsis_muscle_biopsy]}', " .

		"'{$_REQUEST[diagnosis_blood_cell_test]}', " .

		"'{$_REQUEST[diagnosis_mutational]}', " .

		"'{$_REQUEST[submission_date]}')";

		//echo $sql;



		$rs=mysql_query($sql); if (!$rs) {die('Error:' . mysql_error());}

		//Get the New Registrant ID from the database

		$sql = "SELECT LAST_INSERT_ID() as id";

		$rs=mysql_query($sql); if (!$rs) {die('Error:' . mysql_error());}

		$rs_obj=mysql_fetch_object($rs);

		

		$_SESSION['SESSION_ID']= $rs_obj->id;	

		session_register("SESSION_ID");

		

?><script language="javascript">window.location="form2russian.php";</script><?



}

?>

<html>

<head>

<title>Jain Foundation Inc | Patients | Registration Form Part 1</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="style-old.css" type="text/css" />

<style type="text/css">

<!--

.style1 {color: #0033CC}

-->

</style>

</head>

<script language="javascript">

<!--

function validate()

	{  

	

	if(registrant_1.firstName.value == ''){

		alert("First Name is required");

		registrant_1.firstName.focus();

		return false;

	}

		

	if(registrant_1.lastName.value == ''){

		alert("Last Name is required");

		registrant_1.lastName.focus();

		return false;

	}

	

	if(registrant_1.email.value == ''){

		alert("Email is required");

		registrant_1.email.focus();

		return false;

	}

	

	if(registrant_1.cityStateZip.value == ''){

		alert("Postal/Zip Code is required");

		registrant_1.cityStateZip.focus();

		return false;

	}

	

	if(registrant_1.country.selectedIndex == 0){

		alert("Country is required");

		registrant_1.country.focus();

		return false;

	}

	

	if(registrant_1.gender.selectedIndex == 0){

		alert("Gender is required");

		registrant_1.gender.focus();

		return false;

	}

	

		if(registrant_1.currentAge.value == ''){

		alert("Age is required");

		registrant_1.currentAge.focus();

		return false;

	}

	

return true;

}



//-->

</script>

<body leftmargin="0" topmargin="10" marginwidth="0" marginheight="10">         

<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="center">

	

	<table width="780" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="4" background="images/bg_green.gif"></td>

      </tr>

    </table>

	

	<table width="780" height="36" border="0" cellspacing="0" cellpadding="0">

      <tr><? include 'includes/topbar.php'; ?></tr>

    </table>

	

    <table width="780" border="0" cellspacing="0" cellpadding="0">

      <tr height="97">

        <td><a href="index.php"><img src="images/logo_jain-old.gif" width="260" height="97" border="0"></a></td>

        <td><img src="images/logo_jain2-old.gif" width="520" height="97"></td>

      </tr>

    </table>



    <table width="780" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td background="images/bg_dot.gif" width="1"></td>

        <td>



		

		<table width="778" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

          <tr>

            <td width="187" bgcolor="#FDFFC6" height="13"></td>

            <td></td>

          </tr>

          <tr>

            <td bgcolor="#FDFFC6" align="center" valign="top"><table width="168" border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td height="4" bgcolor="#E19012"></td>

                </tr>

                <tr>

                  <td><a href="projects.php" onMouseOver="window.document.sq4.src='images/button_ourFunded_roll.gif'" 

onMouseOut="window.document.sq4.src='images/button_ourFunded.gif'"><img src="images/button_ourFunded.gif" border="0" name="sq4" alt="Our Funded Projects" width="168" height="32"></a></td>

                </tr>

				<tr>

                  <td height="1" background="images/bg_dot2.gif"></td>

                </tr>

				<tr>

                  <td><a href="conferences.php" onMouseOver="window.document.sq15.src='images/button_conferences_roll.gif'" 

onMouseOut="window.document.sq15.src='images/button_conferences.gif'"><img src="images/button_conferences.gif" border="0" name="sq15" alt="Sponsored Conferences" width="168" height="32"></a></td>

                </tr>

                <tr>

                  <td height="1" background="images/bg_dot2.gif"></td>

                </tr>

                <tr>

                  <td><a href="apply.php" onMouseOver="window.document.sq5.src='images/button_apply_roll.gif'" 

onMouseOut="window.document.sq5.src='images/button_apply.gif'"><img src="images/button_apply.gif" border="0" name="sq5" alt="Apply for Funding" width="168" height="32"></a></td>

                </tr>

                <tr>

                  <td height="1" background="images/bg_dot2.gif"></td>

                </tr>

                <tr>

                  <td><a href="papers.php" onMouseOver="window.document.sq6.src='images/button_papers_roll.gif'" 

onMouseOut="window.document.sq6.src='images/button_papers.gif'"><img src="images/button_papers.gif" border="0" name="sq6" alt="Relevant Scientific Papers" width="168" height="32"></a></td>

                </tr>

                <tr>

                  <td height="1" background="images/bg_dot2.gif"></td>

                </tr>

                <tr>

                  <td><img src="images/button_patient_roll.gif" width="168" height="32"></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7"><p class="leftNav">&raquo; <a href="patients.php" class="leftNav">Overview</a></p></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7"><p class="leftNav">&raquo; <a href="register.php" class="leftnav">Registration

                      Form</a></p></td>

                </tr>

				 <tr>

                  <td bgcolor="#FEFFD7"><p class="leftNav">&raquo; <a href="diagnostic.php" class="leftNav">Diagnostic

                        Resources</a></p></td>

                </tr>

				 <tr>

                   <td bgcolor="#FEFFD7"><p class="leftNav">&raquo; <a href="clinicaltrials.php" class="leftNav">Clinical Trial Information </a></p></td>

				   </tr>

				

				<tr>

                  <td bgcolor="#FEFFD7" height="6"></td>

                </tr>

                <tr>

                  <td height="1" background="images/bg_dot2.gif"></td>

                </tr>

                <tr>

                  <td><a href="faq.php" onMouseOver="window.document.sq8.src='images/button_faq_roll.gif'" 

onMouseOut="window.document.sq8.src='images/button_faq.gif'"><img src="images/button_faq.gif" border="0" name="sq8" alt="FAQ on LGMD2B/Miyoshi" width="168" height="32"></a></td>

                </tr>

				<tr>

                  <td height="1" background="images/bg_dot2.gif"></td>

                </tr>

                <tr>

                  <td><a href="links.php" onMouseOver="window.document.sq16.src='images/button_links2_roll.gif'" 

onMouseOut="window.document.sq16.src='images/button_links2.gif'"><img src="images/button_links2.gif" border="0" name="sq16" alt="Helpful Links" width="168" height="32"></a></td>

                </tr>

                <tr>

                  <td height="4" bgcolor="#E19012"></td>

                </tr>

              </table>

			  <? include 'includes/search.php'; ?>

                </td>

            <td valign="top" align="center">

			  <form name="registrant_1" method="post" action="form1russian.php" onSubmit="return validate();">

  			 <input type="hidden" name="action" value="save">

			

			<table width="94%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td valign="top" height="13"></td>

              </tr>

              <tr>

                <td valign="top"><p class="section">&#1056;&#1077;&#1075;&#1080;&#1089;&#1090;&#1088;&#1072;&#1094;&#1080;&#1103; &#1041;&#1086;&#1083;&#1100;&#1085;&#1086;&#1075;&#1086; </p>

                    <p class="home"> <strong><font color="#0175C2"> &#1056;&#1077;&#1075;&#1080;&#1089;&#1090;&#1088;&#1072;&#1094;&#1080;&#1086;&#1085;&#1085;&#1072;&#1103; &#1040;&#1085;&#1082;&#1077;&#1090;&#1072; </font></strong><br>

  &#1069;&#1090;&#1072; &#1072;&#1085;&#1082;&#1077;&#1090;&#1072; &#1089;&#1086;&#1089;&#1090;&#1086;&#1080;&#1090; &#1080;&#1079; &#1090;&#1088;&#1105;&#1093; &#1095;&#1072;&#1089;&#1090;&#1077;&#1081; &#1080; &#1079;&#1072;&#1080;&#1084;&#1077;&#1090; &#1086;&#1082;&#1086;&#1083;&#1086; 15 &#1084;&#1080;&#1085;&#1091;&#1090;. &#1042;&#1072;&#1096;&#1080; &#1086;&#1090;&#1074;&#1077;&#1090;&#1099; &#1087;&#1086;&#1084;&#1086;&#1075;&#1091;&#1090; &#1085;&#1072;&#1096;&#1077;&#1084;&#1091; &#1072;&#1085;&#1072;&#1083;&#1080;&#1079;&#1091; &#1088;&#1072;&#1079;&#1085;&#1086;&#1086;&#1073;&#1088;&#1072;&#1079;&#1085;&#1086;&#1075;&#1086; &#1088;&#1072;&#1079;&#1074;&#1080;&#1090;&#1080;&#1103; &#1079;&#1072;&#1073;&#1086;&#1083;&#1077;&#1074;&#1072;&#1085;&#1080;&#1103; LMGD. &#1053;&#1077;&#1082;&#1086;&#1090;&#1086;&#1088;&#1099;&#1077; &#1086;&#1090;&#1074;&#1077;&#1090;&#1099; &#1085;&#1077; &#1103;&#1074;&#1083;&#1103;&#1102;&#1090;&#1089;&#1103; &#1086;&#1073;&#1103;&#1079;&#1072;&#1090;&#1077;&#1083;&#1100;&#1085;&#1099;&#1084;&#1080;, &#1085;&#1086; &#1087;&#1086;&#1078;&#1072;&#1083;&#1091;&#1081;&#1089;&#1090;&#1072; &#1087;&#1086;&#1089;&#1090;&#1072;&#1088;&#1072;&#1081;&#1090;&#1077;&#1089;&#1100; &#1079;&#1072;&#1087;&#1086;&#1083;&#1085;&#1080;&#1090;&#1100; &#1092;&#1086;&#1088;&#1084;&#1091; &#1087;&#1086;&#1083;&#1085;&#1086;&#1089;&#1090;&#1100;&#1102;.

  <br> 

  <strong>&#1042;&#1089;&#1103; &#1087;&#1088;&#1077;&#1076;&#1086;&#1089;&#1090;&#1072;&#1074;&#1083;&#1077;&#1085;&#1085;&#1072;&#1103; &#1074;&#1072;&#1084;&#1080; &#1080;&#1085;&#1092;&#1086;&#1088;&#1084;&#1072;&#1094;&#1080;&#1103; &#1089;&#1090;&#1088;&#1086;&#1075;&#1086; &#1082;&#1086;&#1085;&#1092;&#1080;&#1076;&#1077;&#1085;&#1094;&#1080;&#1072;&#1083;&#1100;&#1085;&#1072;!</strong><br>

  This website is secure and protected by SSL encryption.<br>

  <br>

  &#1045;&#1089;&#1083;&#1080; &#1074;&#1099; &#1085;&#1077; &#1093;&#1086;&#1090;&#1080;&#1090;&#1077; &#1088;&#1077;&#1075;&#1080;&#1089;&#1090;&#1088;&#1080;&#1088;&#1086;&#1074;&#1072;&#1090;&#1089;&#1103; &#1085;&#1072; &#1085;&#1072;&#1096;&#1077;&#1084; &#1089;&#1072;&#1081;&#1090;&#1077;, &#1085;&#1072;&#1084; &#1073;&#1099; &#1074;&#1089;&#1105; &#1088;&#1072;&#1074;&#1085;&#1086; &#1093;&#1086;&#1090;&#1077;&#1083;&#1086;&#1089;&#1100; &#1091;&#1089;&#1083;&#1099;&#1096;&#1072;&#1090;&#1100; &#1086;&#1090; &#1074;&#1072;&#1089;

  &#1055;&#1086;&#1078;&#1072;&#1083;&#1091;&#1081;&#1089;&#1090;&#1072; &#1089;&#1074;&#1103;&#1078;&#1080;&#1090;&#1077;&#1089;&#1100; &#1089; &#1044;&#1086;&#1082;&#1090;&#1086;&#1088;&#1086;&#1084; &#1055;&#1083;&#1072;&#1074;&#1080; &#1052;&#1080;&#1090;&#1090;&#1072;&#1083;&#1086;&#1084; &#1087;&#1086; &#1077;&#1075;&#1086; e-mail <a href="mailto:plavimittal@jain-foundation.org">plavimittal@jain-foundation.org</a><br>

                        <br>

                        <a href="form1.php"><img src="images/English.png" width="24" height="16" border="0"></a> <a href="form1.php" class="style1">English</a> &nbsp;&nbsp;&nbsp;<a href="form1spanish.php"><img src="images/Spanish.png" width="24" height="16" border="0"></a> <a href="form1spanish.php" class="style1">Espa&ntilde;ol</a> &nbsp;&nbsp;&nbsp;<a href="form1italian.php"><img src="images/Italian.png" width="24" height="16" border="0"></a> <a href="form1italian.php" class="style1">Italiano</a> &nbsp;&nbsp;&nbsp;<a href="form1dutch.php"><img src="images/Dutch.png" width="24" height="16" border="0"></a> <a href="form1dutch.php" class="style1">Nederlands</a> &nbsp;&nbsp;&nbsp;<a href="form1german.php"><img src="images/German.png" width="24" height="16" border="0"></a> <a href="form1german.php" class="style1">Deutsch</a> &nbsp;&nbsp;&nbsp;<br><br>

<a href="form1french.php"><img src="images/French.png" width="24" height="16" border="0"></a> <a href="form1french.php" class="style1">Fran&ccedil;ais</a> &nbsp;&nbsp;&nbsp;<a href="form1polish.php"><img src="images/Polish.png" width="24" height="16" border="0"></a> <a href="form1polish.php" class="style1">Polski</a> &nbsp;&nbsp;&nbsp;<a href="form1russian.php"><img src="images/Russian.png" width="24" height="16" border="0"></a> <A href="form1russian.php" class="style1">&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;</A> &nbsp;&nbsp;&nbsp;<a href="form1chinese.php"><img src="images/Chinese.png" width="24" height="16" border="0"></a> <a href="form1chinese.php" class="style1">&#27491;&#39636;&#23383;/&#32321;&#39636;&#23383;</a> &nbsp;&nbsp;&nbsp;<a href="form1schinese.php"><img src="images/SChinese.png" width="24" height="16" border="0"></a> <a href="form1schinese.php" class="style1"><SPAN lang="zh-Hans" xml:lang="zh-Hans">&#31616;&#20307;&#23383;</SPAN>/<SPAN lang="zh-Hans" xml:lang="zh-Hans">&#31616;&#21270;&#23383;</SPAN></a> <br><br>

<a href="form1japanese.php"><img src="images/Japanese.png" width="24" height="16" border="0"></a> <a href="form1japanese.php" class="style1"><SPAN lang="ja" xml:lang="ja">&#26085;&#26412;&#35486;</SPAN></a><br>

                        <br>

                        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript" SRC="//smarticon.geotrust.com/si.js"></SCRIPT>

                        <br>

                        <br>

                        <strong><font color="#990000">&#1055;&#1077;&#1088;&#1074;&#1072;&#1103; &#1063;&#1072;&#1089;&#1090;&#1100;: &#1051;&#1080;&#1095;&#1085;&#1099;&#1077; &#1044;&#1072;&#1085;&#1085;&#1099;&#1077;</font></strong><br>

                        <br>

                    </p>

                    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">

                      <tr bgcolor="#F3F9FA">

                        <td width="30%"><p class="form">&#1048;&#1084;&#1103;</p></td>

                        <td bgcolor="#F3F9FA"><input name="firstName" type="text" id="firstName" maxlength="50"></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#1060;&#1072;&#1084;&#1080;&#1083;&#1080;&#1103;</p></td>

                        <td><input name="lastName" type="text" id="lastName" maxlength="50"></td>

                      </tr>

                      <tr bgcolor="#F3F9FA">

                       <td bgcolor="#F3F9FA"><p class="form">&#1040;&#1076;&#1088;&#1077;&#1089; &#1101;&#1083;&#1077;&#1082;&#1090;&#1088;&#1086;&#1085;&#1085;&#1086;&#1081; &#1087;&#1086;&#1095;&#1090;&#1099;</p></td>

                        <td><input name="email" type="text" id="email" maxlength="50"></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#1058;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;</p></td>

                        <td><input name="phone" type="text" id="phone" maxlength="50"></td>

                      </tr>

                      <tr bgcolor="#F3F9FA">

                        <td><p class="form">&#1040;&#1076;&#1088;&#1077;&#1089;</p></td>

                        <td><input name="address" type="text" id="address" maxlength="50"></td>

                      </tr>

                      <tr>

                        <td><p class="form">&#1043;&#1086;&#1088;&#1086;&#1076;, &#1064;&#1090;&#1072;&#1090;, &#1055;&#1086;&#1095;&#1090;&#1086;&#1074;&#1099;&#1081; &#1082;&#1086;&#1076;</p></td>

                        <td><input name="cityStateZip" type="text" id="cityStateZip" maxlength="50"></td>

                      </tr>

					  <tr bgcolor="#F3F9FA">

                        <td width="30%"><p class="form">&#1057;&#1090;&#1088;&#1072;&#1085;&#1072;</p></td>

                        <td><? countries(); ?></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#1055;&#1086;&#1083;</p></td>

                        <td><select name="gender" id="gender">

                          <option>&#1042;&#1099;&#1073;&#1077;&#1088;&#1077;&#1090;&#1077; &#1087;&#1086;&#1076;&#1093;&#1086;&#1076;&#1103;&#1097;&#1080;&#1081;... </option>

                          <option>&#1052;&#1091;&#1078;&#1089;&#1082;&#1086;&#1081;</option>

                          <option>&#1046;&#1077;&#1085;&#1089;&#1082;&#1080;&#1081;</option>                

                            </select></td>

                      </tr>

                      <tr bgcolor="#F3F9FA">

                       <td bgcolor="#F3F9FA"><p class="form">&#1042;&#1072;&#1096; &#1053;&#1072;&#1089;&#1090;&#1086;&#1103;&#1097;&#1080;&#1081; &#1042;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;</p></td>

                        <td bgcolor="#F3F9FA"><input name="currentAge" type="text" id="currentAge" size="3" maxlength="3"></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#1042;&#1072;&#1096; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090; &#1085;&#1072; &#1084;&#1086;&#1084;&#1077;&#1085;&#1090; &#1076;&#1080;&#1072;&#1075;&#1085;&#1086;&#1079;&#1072;</p></td>

                        <td><input name="diagnosisAge" type="text" id="diagnosisAge" size="3" maxlength="3"></td>

                      </tr>

                    </table>



                 

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td height="10"></td>

                      </tr>

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#1050;&#1072;&#1082;&#1080;&#1077; &#1080;&#1079; &#1101;&#1090;&#1080;&#1093; &#1087;&#1088;&#1086;&#1094;&#1077;&#1076;&#1091;&#1088; &#1087;&#1088;&#1080;&#1084;&#1077;&#1085;&#1103;&#1083;&#1080;&#1089;&#1100; &#1074; &#1087;&#1086;&#1089;&#1090;&#1072;&#1085;&#1086;&#1074;&#1082;&#1077; &#1074;&#1072;&#1096;&#1077;&#1075;&#1086; &#1076;&#1080;&#1072;&#1075;&#1085;&#1086;&#1079;&#1072;?<br>

a.</strong> &#1060;&#1080;&#1079;&#1080;&#1086;&#1083;&#1086;&#1075;&#1080;&#1095;&#1077;&#1089;&#1082;&#1080;&#1081; &#1086;&#1089;&#1084;&#1086;&#1090;&#1088;

<input type="radio" name="diagnosis_examination" value="Yes">

&#1044;&#1072; 

						  &nbsp;&nbsp;

						  <input type="radio" name="diagnosis_examination" value="No">

						  &#1053;&#1077;&#1090; 

                          &nbsp;&nbsp;

                          <input type="radio" name="diagnosis_examination" value="Not Sure">

                          &#1053;&#1077; &#1047;&#1085;&#1072;&#1102; <br>

                          <strong>b</strong>.	&#1048;&#1079;&#1084;&#1077;&#1088;&#1077;&#1085;&#1080;&#1077; &#1091;&#1088;&#1086;&#1074;&#1085;&#1103; &#1082;&#1088;&#1077;&#1072;&#1090;&#1080;&#1085;-&#1082;&#1080;&#1085;&#1072;&#1079;&#1099;

                          <input type="radio" name="diagnosis_CK_level" value="Yes">

                          &#1044;&#1072; 

						  &nbsp;&nbsp;

						  <input type="radio" name="diagnosis_CK_level" value="No">

						  &#1053;&#1077;&#1090; 

                          &nbsp;&nbsp;

                          <input type="radio" name="diagnosis_CK_level" value="Not Sure">

&#1053;&#1077; &#1047;&#1085;&#1072;&#1102; &nbsp;&nbsp;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          &#1050;&#1072;&#1082;&#1086;&#1074; &#1073;&#1099;&#1083; &#1074;&#1072;&#1096; &#1091;&#1088;&#1086;&#1074;&#1077;&#1085;&#1100; &#1082;&#1088;&#1077;&#1072;&#1090;&#1080;&#1085;-&#1082;&#1080;&#1085;&#1072;&#1079;&#1099; &#1085;&#1072; &#1084;&#1086;&#1084;&#1077;&#1085;&#1090; &#1076;&#1080;&#1072;&#1075;&#1085;&#1086;&#1079;&#1072;?

                          <input name="diagnosis_CK_level_number" type="text" size="3" maxlength="8">

                          <br>

                          <strong>c.</strong> &#1052;&#1099;&#1096;&#1077;&#1095;&#1085;&#1072;&#1103; &#1073;&#1080;&#1086;&#1087;&#1089;&#1080;&#1103;

                          <input type="radio" name="diagonsis_muscle_biopsy" value="Yes">

                          &#1044;&#1072; 

						  &nbsp;&nbsp;

						  <input type="radio" name="diagonsis_muscle_biopsy" value="No">

						  &#1053;&#1077;&#1090; 

                          &nbsp;&nbsp;

                          <input type="radio" name="diagonsis_muscle_biopsy" value="Not Sure">

                          &#1053;&#1077; &#1047;&#1085;&#1072;&#1102; <br>

                          <strong>d.</strong> &#1040;&#1085;&#1072;&#1083;&#1080;&#1079; &#1091;&#1088;&#1086;&#1074;&#1085;&#1103; &#1084;&#1086;&#1085;&#1086;&#1094;&#1080;&#1090;&#1086;&#1074;

                          <input type="radio" name="diagnosis_blood_cell_test" value="Yes">

                          &#1044;&#1072; 

						  &nbsp;&nbsp;

						  <input type="radio" name="diagnosis_blood_cell_test" value="No">

						  &#1053;&#1077;&#1090; 

                          &nbsp;&nbsp;

                          <input type="radio" name="diagnosis_blood_cell_test" value="Not Sure">

                          &#1053;&#1077; &#1047;&#1085;&#1072;&#1102; <br>

                          <strong>e.</strong> &#1040;&#1085;&#1072;&#1083;&#1080;&#1079; &#1044;&#1053;&#1050;

                          <input type="radio" name="diagnosis_mutational" value="Yes">

                          &#1044;&#1072; 

						  &nbsp;&nbsp;

						  <input type="radio" name="diagnosis_mutational" value="No">

						  &#1053;&#1077;&#1090; 

                          &nbsp;&nbsp;

                          <input type="radio" name="diagnosis_mutational" value="Not Sure">

                          &#1053;&#1077; &#1047;&#1085;&#1072;&#1102; </p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#1044;&#1072;&#1090;&#1072; &#1079;&#1072;&#1087;&#1086;&#1083;&#1085;&#1077;&#1085;&#1080;&#1103; &#1072;&#1085;&#1082;&#1077;&#1090;&#1099;

                              <input name="submission_date" type="text" value="<?=$myDate;?>" size="10" maxlength="50">

                        </strong></p></td>

                      </tr>

                      <tr>

                        <td align="center" height="40">

                          <input  name="Continue" type="submit" id="Continue" value=&#1044;&#1072;&#1083;&#1077;&#1077;>&nbsp;&nbsp;&nbsp;

                          <input name="Reset" type="reset" id="Reset" value=&#1057;&#1073;&#1088;&#1086;&#1089;></td></tr>

                      <tr>

                        <td height="20"><div align="center">Please view our <a href="legal.php" target="_blank" class="style1">legal disclaimer</a> before submitting.</div></td>

                      </tr>

                    </table>

                    </td>

              </tr>

            </table>

			</form>

			

			</td>

          </tr>

          <tr>

            <td bgcolor="#FDFFC6" align="center" valign="top">&nbsp;</td>

            <td bgcolor="ffffff">&nbsp;</td>

          </tr>

          <tr>

            <td height="30" align="right" bgcolor="#FDFFC6"></td>

            <td height="30" align="right" valign="middle" bgcolor="#FDFFC6"><p class="footer">

                <? include 'includes/footer.php'; ?>

              </p>

            </td>

          </tr>

        </table></td>

        <td background="images/bg_dot.gif" width="1"></td>

      </tr>

    </table>

    <table width="780" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="4" background="images/bg_green.gif"></td>

      </tr>

    </table>

	

	</td>

  </tr>

</table>



</body>

</html>



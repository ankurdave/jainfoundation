<?

	session_start();

	if(isset($_SESSION['SESSION_ID'])){

		$login = true;
		include('includes/fixvars.php');

	}else{

		session_destroy();

		$login=false;

		include "form1russian.php";

		exit;

	}



include('includes/mysql.php');



if(@$_REQUEST["action"]=="save")

{



$sql=	"UPDATE registrants SET " .

		"age_symptoms = '{$_REQUEST['age_symptoms']}', " .

		"scooter = '{$_REQUEST['scooter']}', " .

		"scooter_age = '{$_REQUEST['scooter_age']}', " .

		"cane = '{$_REQUEST['cane']}', " .

		"cane_age = '{$_REQUEST['cane_age']}', " .

		"leg_braces  = '{$_REQUEST['leg_braces']}', " .

		"leg_braces_age  = '{$_REQUEST['leg_braces_age']}', " .

		"walk_without_assistance  = '{$_REQUEST['walk_without_assistance']}', " .

		"stand_no_support  = '{$_REQUEST['stand_no_support']}', " .

		"tiptoes  = '{$_REQUEST['tiptoes']}', " .

		"tiptoes_age  = '{$_REQUEST['tiptoes_age']}', " .

		"rising_sitting_position  = '{$_REQUEST['rising_sitting_position']}', " .

		"rising_sitting_position_age = '{$_REQUEST['rising_sitting_position_age']}', " .

		"rising_sitting_position_explained  = '{$_REQUEST['rising_sitting_position_explained']}', " .

		"sitting_horizontal = '{$_REQUEST['sitting_horizontal']}', " .

		"sitting_horizontal_age = '{$_REQUEST['sitting_horizontal_age']}', " .

		"climbing_stairs = '{$_REQUEST['climbing_stairs']}', " .

		"climbing_stairs_age = '{$_REQUEST['climbing_stairs_age']}', " .

		"climbing_stairs_explained  = '{$_REQUEST['climbing_stairs_explained']}', " .

		"elevation = '{$_REQUEST['elevation']}', " .

		"elevation_age = '{$_REQUEST['elevation_age']}', " .

		"raising_arm_above_head = '{$_REQUEST['raising_arm_above_head']}', " .

		"raising_arm_above_head_age = '{$_REQUEST['raising_arm_above_head_age']}', " .

		"glass_of_water  = '{$_REQUEST['glass_of_water']}', " .

		"glass_of_water_age = '{$_REQUEST['glass_of_water_age']}', " .

		"opening_jar = '{$_REQUEST['opening_jar']}', " .

		"opening_jar_age = '{$_REQUEST['opening_jar_age']}', " .

		"carrying_milk = '{$_REQUEST['carrying_milk']}', " .

		"carrying_milk_age = '{$_REQUEST['carrying_milk_age']}', " .

		"turning_car_wheel = '{$_REQUEST['turning_car_wheel_age']}', " .

		"turning_car_wheel_age = '{$_REQUEST['turning_car_wheel_age']}', " .

		"typing = '{$_REQUEST['typing']}', " .

		"typing_age = '{$_REQUEST['typing_age']}', " .

		"respiratory_difficulties = '{$_REQUEST['respiratory_difficulties']}', " .

		"factors_symptoms = '{$_REQUEST['factors_symptoms']}', " .

		"sports = '{$_REQUEST['sports']}', " .

		"neurological = '{$_REQUEST['neurological']}' " .

  		"WHERE patient_id = " . $_SESSION['SESSION_ID'];

  

 // echo $sql;

  	$rs=mysql_query($sql); if (!$rs) {die('Error:' . mysql_error());}

	?><script language="javascript">window.location="thankyourussian.php";</script><?



}



?>

<html>

<head>

<title>Jain Foundation Inc | Patients | Registration Form Part 3</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="style-old.css" type="text/css" />

</head>



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

      <tr>

        <td background="images/bg_topNav.gif">&nbsp;</td>

        <td width="52" height="36"><a href="index.php" onMouseOver="window.document.sq1.src='images/button_home_roll.gif'" 

onMouseOut="window.document.sq1.src='images/button_home.gif'"><img src="images/button_home.gif" border="0" name="sq1" alt="Home" width="52" height="36"></a></td>

        <td width="96" height="36"><a href="links.php" onMouseOver="window.document.sq2.src='images/button_links_roll.gif'" 

onMouseOut="window.document.sq2.src='images/button_links.gif'"><img src="images/button_links.gif" border="0" name="sq2" alt="Links" width="96" height="36"></a></td>

        <td width="84" height="36"><a href="contact.php" onMouseOver="window.document.sq3.src='images/button_contact_roll.gif'" 

onMouseOut="window.document.sq3.src='images/button_contact.gif'"><img src="images/button_contact.gif" border="0" name="sq3" alt="Contact" width="84" height="36"></a></td>

      </tr>

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

        <td><table width="778" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

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

                  <td height="4" bgcolor="#E19012"></td>

                </tr>

              </table>

			  <? include 'includes/search.php'; ?>

                </td>

            <td valign="top" align="center">

			

				  <form name="registrant_3" method="post" action="form3russian.php">

   <input type="hidden" name="action" value="save">

			

			<table width="94%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td valign="top" height="13"></td>

              </tr>

              <tr>

                <td valign="top"><p class="section">&#1056;&#1077;&#1075;&#1080;&#1089;&#1090;&#1088;&#1072;&#1094;&#1080;&#1103; &#1041;&#1086;&#1083;&#1100;&#1085;&#1086;&#1075;&#1086;</p>

                    <p class="home"> <strong><font color="#0175C2"> &#1056;&#1077;&#1075;&#1080;&#1089;&#1090;&#1088;&#1072;&#1094;&#1080;&#1086;&#1085;&#1085;&#1072;&#1103; &#1040;&#1085;&#1082;&#1077;&#1090;&#1072; </font></strong><br>

  &#1055;&#1086;&#1078;&#1072;&#1083;&#1091;&#1081;&#1089;&#1090;&#1072; &#1079;&#1072;&#1087;&#1086;&#1083;&#1085;&#1103;&#1081;&#1090;&#1077; &#1076;&#1072;&#1083;&#1077;&#1077;.<br>

  <strong> &#1042;&#1089;&#1103; &#1087;&#1088;&#1077;&#1076;&#1086;&#1089;&#1090;&#1072;&#1074;&#1083;&#1077;&#1085;&#1085;&#1072;&#1103; &#1074;&#1072;&#1084;&#1080; &#1080;&#1085;&#1092;&#1086;&#1088;&#1084;&#1072;&#1094;&#1080;&#1103; &#1089;&#1090;&#1088;&#1086;&#1075;&#1086; &#1082;&#1086;&#1085;&#1092;&#1080;&#1076;&#1077;&#1085;&#1094;&#1080;&#1072;&#1083;&#1100;&#1085;&#1072;!</strong><br>

  <br>

  <strong><font color="#990000">&#1058;&#1088;&#1077;&#1090;&#1100;&#1103; &#1063;&#1072;&#1089;&#1090;&#1100;: &#1054; &#1074;&#1072;&#1096;&#1080;&#1093; &#1089;&#1080;&#1084;&#1087;&#1090;&#1086;&#1084;&#1072;&#1093;</font></strong> (&#1085;&#1077;&#1086;&#1073;&#1103;&#1079;&#1072;&#1090;&#1077;&#1083;&#1100;&#1085;&#1086;)<br>

                    </p>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1074;&#1099; &#1074;&#1087;&#1077;&#1088;&#1074;&#1099;&#1077; &#1087;&#1086;&#1095;&#1091;&#1074;&#1089;&#1090;&#1074;&#1072;&#1083;&#1080; &#1089;&#1080;&#1084;&#1087;&#1090;&#1086;&#1084;&#1099; LGMD2B?

                          <input name="age_symptoms" type="text" size="3">

                        </strong></p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#1050;&#1072;&#1082;&#1080;&#1084;&#1080; &#1080;&#1079; &#1101;&#1090;&#1080;&#1093; &#1086;&#1088;&#1090;&#1086;&#1087;&#1077;&#1076;&#1080;&#1095;&#1077;&#1089;&#1082;&#1080;&#1093; &#1087;&#1088;&#1080;&#1089;&#1087;&#1086;&#1089;&#1086;&#1073;&#1083;&#1077;&#1085;&#1080;&#1081; &#1074;&#1099; &#1087;&#1086;&#1083;&#1100;&#1079;&#1091;&#1077;&#1090;&#1077;&#1089;&#1100;? <br>

a.</strong> &#1050;&#1088;&#1077;&#1089;&#1083;&#1086;-&#1082;&#1072;&#1090;&#1072;&#1083;&#1082;&#1072;?

<input type="radio" name="scooter" value="always">

&#1042;&#1089;&#1077;&#1075;&#1076;&#1072;&nbsp;&nbsp;

<input type="radio" name="scooter" value="sometimes">

&#1048;&#1085;&#1086;&#1075;&#1076;&#1072;&nbsp;&nbsp;

<input type="radio" name="scooter" value="never">

&#1053;&#1080;&#1082;&#1086;&#1075;&#1076;&#1072;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1057; &#1082;&#1072;&#1082;&#1086;&#1075;&#1086; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1072;?

<input name="scooter_age" type="text" size="3">

<br>

<strong>b</strong>.</strong> &#1058;&#1088;&#1086;&#1089;&#1090;&#1100;?

<input type="radio" name="cane" value="always">

&#1042;&#1089;&#1077;&#1075;&#1076;&#1072;&nbsp;&nbsp;

<input type="radio" name="cane" value="sometimes">

&#1048;&#1085;&#1086;&#1075;&#1076;&#1072;&nbsp;&nbsp;

<input type="radio" name="cane" value="never">

&#1053;&#1080;&#1082;&#1086;&#1075;&#1076;&#1072;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1057; &#1082;&#1072;&#1082;&#1086;&#1075;&#1086; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1072;?

<input name="cane_age" type="text" size="3">

<br>

<strong>c.</strong></strong> &#1048;&#1084;&#1084;&#1086;&#1073;&#1080;&#1083;&#1080;&#1079;&#1072;&#1090;&#1086;&#1088;&#1099; &#1076;&#1083;&#1103; &#1085;&#1086;&#1075;?

<input type="radio" name="leg_braces" value="always">

&#1042;&#1089;&#1077;&#1075;&#1076;&#1072;&nbsp;&nbsp;

<input type="radio" name="leg_braces" value="sometimes">

&#1048;&#1085;&#1086;&#1075;&#1076;&#1072;&nbsp;&nbsp;

<input type="radio" name="leg_braces" value="never">

&#1053;&#1080;&#1082;&#1086;&#1075;&#1076;&#1072;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1057; &#1082;&#1072;&#1082;&#1086;&#1075;&#1086; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1072;?

<input name="leg_braces_age" type="text" size="3">

</p></td>

                      </tr>

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#1050;&#1072;&#1082; &#1076;&#1072;&#1083;&#1077;&#1082;&#1086; &#1074;&#1099; &#1089;&#1084;&#1086;&#1078;&#1077;&#1090;&#1077; &#1089;&#1072;&#1084;&#1086;&#1089;&#1090;&#1086;&#1103;&#1090;&#1077;&#1083;&#1100;&#1085;&#1086; &#1087;&#1088;&#1086;&#1081;&#1090;&#1080;? </strong><br>

                            <input type="radio" name="walk_without_assistance" value="not at all">

                            &#1053;&#1077; &#1084;&#1086;&#1075;&#1091;

						  &nbsp;&nbsp;

						  <input type="radio" name="walk_without_assistance" value="few steps only ">

						  &#1053;&#1077;&#1089;&#1082;&#1086;&#1083;&#1100;&#1082;&#1086; &#1096;&#1072;&#1075;&#1086;&#1074;

                          &nbsp;&nbsp;

                          <input type="radio" name="walk_without_assistance" value="across a room only">

                          &#1063;&#1077;&#1088;&#1077;&#1079; &#1082;&#1086;&#1084;&#1085;&#1072;&#1090;&#1091;

						  &nbsp;&nbsp;<br>

						  <input type="radio" name="walk_without_assistance" value="a block only">

						  &#1053;&#1077; &#1073;&#1086;&#1083;&#1077;&#1077; &#1082;&#1074;&#1072;&#1088;&#1090;&#1072;&#1083;&#1072;

						  &nbsp;&nbsp;

						  <input type="radio" name="walk_without_assistance" value="a mile or more">

						  &#1041;&#1086;&#1083;&#1077;&#1077; &#1082;&#1080;&#1083;&#1086;&#1084;&#1077;&#1090;&#1088;&#1072; </p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#1050;&#1072;&#1082; &#1076;&#1086;&#1083;&#1075;&#1086; &#1074;&#1099; &#1089;&#1084;&#1086;&#1078;&#1077;&#1090;&#1077; &#1089;&#1090;&#1086;&#1103;&#1090;&#1100; &#1073;&#1077;&#1079; &#1074;&#1089;&#1103;&#1082;&#1086;&#1081; &#1086;&#1087;&#1086;&#1088;&#1099;?

                          <input name="stand_no_support" type="text">

                        </strong></p></td>

                      </tr>

                       <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#1058;&#1088;&#1091;&#1076;&#1085;&#1086; &#1083;&#1080; &#1074;&#1072;&#1084; :<br>

a.</strong> &#1057;&#1090;&#1086;&#1103;&#1090;&#1100; &#1085;&#1072; &#1094;&#1099;&#1087;&#1086;&#1095;&#1082;&#1072;&#1093;?

<input type="radio" name="tiptoes" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;

						  &nbsp;&nbsp;

                          <input type="radio" name="tiptoes" value="no">

&#1053;&#1077;&#1090;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="tiptoes_age" type="text" size="3">

<br>

<strong>b</strong>.	&#1042;&#1089;&#1090;&#1072;&#1074;&#1072;&#1090;&#1100; &#1089; &#1089;&#1080;&#1076;&#1103;&#1095;&#1077;&#1075;&#1086; &#1087;&#1086;&#1083;&#1086;&#1078;&#1077;&#1085;&#1080;&#1103;?

<input type="radio" name="rising_sitting_position" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;

						  &nbsp;&nbsp;

                          <input type="radio" name="rising_sitting_position" value="no">

&#1053;&#1077;&#1090;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="rising_sitting_position_age" type="text" size="3">

<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1045;&#1089;&#1090;&#1100; &#1083;&#1080; &#1091; &#1074;&#1072;&#1089; &#1082;&#1072;&#1082;&#1086;&#1081;-&#1085;&#1080;&#1073;&#1091;&#1076;&#1100; &#1086;&#1073;&#1083;&#1077;&#1075;&#1095;&#1072;&#1102;&#1097;&#1080;&#1081; &#1084;&#1077;&#1090;&#1086;&#1076;? (&#1090;.&#1077;. &#1074;&#1089;&#1090;&#1072;&#1090;&#1100; &#1089; &#1087;&#1086;&#1084;&#1086;&#1097;&#1100;&#1102; &#1088;&#1091;&#1082;? )<br>

&nbsp;&nbsp;&nbsp;

<textarea name="rising_sitting_position_explained" cols="40" rows="4"></textarea>

<br>

<strong>c.</strong> &#1042;&#1089;&#1090;&#1072;&#1074;&#1072;&#1090;&#1100; &#1080;&#1079; &#1075;&#1086;&#1088;&#1080;&#1079;&#1086;&#1085;&#1090;&#1072;&#1083;&#1100;&#1085;&#1086;&#1075;&#1086; &#1087;&#1086;&#1083;&#1086;&#1078;&#1077;&#1085;&#1080;&#1103;?

<input type="radio" name="sitting_horizontal" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;

						  &nbsp;&nbsp;

                          <input type="radio" name="sitting_horizontal" value="no">

&#1053;&#1077;&#1090; <br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="sitting_horizontal_age" type="text" size="3">

<br>

<strong>d</strong>.	&#1055;&#1086;&#1076;&#1085;&#1080;&#1084;&#1072;&#1090;&#1089;&#1103; &#1087;&#1086; &#1083;&#1077;&#1089;&#1090;&#1085;&#1080;&#1094;&#1077; &#1073;&#1077;&#1079; &#1087;&#1077;&#1088;&#1080;&#1083; &#1080;&#1083;&#1080; &#1090;&#1088;&#1086;&#1089;&#1090;&#1080;?

<input type="radio" name="climbing_stairs" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;&nbsp;&nbsp;

<input type="radio" name="climbing_stairs" value="no">

&#1053;&#1077;&#1090;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="climbing_stairs_age" type="text" size="3">

<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#1055;&#1086;&#1076;&#1085;&#1080;&#1084;&#1072;&#1090;&#1089;&#1103; &#1087;&#1086; &#1083;&#1077;&#1089;&#1090;&#1085;&#1080;&#1094;&#1077; &#1089; &#1086;&#1087;&#1086;&#1088;&#1086;&#1081;? &#1055;&#1086;&#1078;&#1072;&#1083;&#1091;&#1080;&#1089;&#1090;&#1072;, &#1086;&#1073;&#1098;&#1103;&#1089;&#1085;&#1080;&#1090;&#1077; &#1087;&#1086;&#1076;&#1088;&#1086;&#1073;&#1085;&#1077;&#1077;.<br>

&nbsp;&nbsp;&nbsp;

<textarea name="climbing_stairs_explained" cols="40" rows="4"></textarea>

<br>

<strong>e.</strong> &#1055;&#1086;&#1076;&#1085;&#1080;&#1084;&#1072;&#1090;&#1089;&#1103; &#1087;&#1086; &#1085;&#1077;&#1082;&#1088;&#1091;&#1090;&#1086;&#1084;&#1091; &#1089;&#1082;&#1083;&#1086;&#1085;&#1091;?

<input type="radio" name="elevation" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;

						  &nbsp;&nbsp;

                          <input type="radio" name="elevation" value="no">

&#1053;&#1077;&#1090; <br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="elevation_age" type="text" size="3">

<br>

<strong>f.</strong> &#1055;&#1086;&#1076;&#1085;&#1103;&#1090;&#1100; &#1088;&#1091;&#1082;&#1080; &#1085;&#1072;&#1076; &#1075;&#1086;&#1083;&#1086;&#1074;&#1086;&#1081;?

<input type="radio" name="raising_arm_above_head" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;

						  &nbsp;&nbsp;

                          <input type="radio" name="raising_arm_above_head" value="no">

&#1053;&#1077;&#1090; <br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="raising_arm_above_head_age" type="text" size="3">

<br>

<strong>g.</strong> &#1055;&#1086;&#1076;&#1085;&#1103;&#1090;&#1100; &#1089;&#1090;&#1072;&#1082;&#1072;&#1085; &#1089; &#1074;&#1086;&#1076;&#1086;&#1081;?

<input type="radio" name="glass_of_water" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;&nbsp;&nbsp;

<input type="radio" name="glass_of_water" value="no">

&#1053;&#1077;&#1090;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="glass_of_water_age" type="text" size="3">

<br>

<strong>h.</strong> &#1054;&#1090;&#1082;&#1088;&#1091;&#1090;&#1080;&#1090;&#1100; &#1082;&#1088;&#1099;&#1096;&#1082;&#1091; &#1082;&#1086;&#1085;&#1089;&#1077;&#1088;&#1074;&#1085;&#1086;&#1081; &#1073;&#1072;&#1085;&#1082;&#1080;?

<input type="radio" name="opening_jar" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;&nbsp;&nbsp;

<input type="radio" name="opening_jar" value="no">

&#1053;&#1077;&#1090;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="opening_jar_age" type="text" size="3">

<br>

<strong>i.</strong> &#1055;&#1077;&#1088;&#1077;&#1085;&#1077;&#1089;&#1090;&#1080;?

<input type="radio" name="carrying_milk" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;&nbsp;&nbsp;

<input type="radio" name="carrying_milk" value="no">

&#1053;&#1077;&#1090;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="carrying_milk_age" type="text" size="3">

<br>

<strong>j.</strong> &#1055;&#1086;&#1074;&#1086;&#1088;&#1072;&#1095;&#1080;&#1074;&#1072;&#1090;&#1100; &#1088;&#1091;&#1083;&#1100; &#1084;&#1072;&#1096;&#1080;&#1085;&#1099;?

<input type="radio" name="turning_car_wheel" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;&nbsp;&nbsp;

<input type="radio" name="turning_car_wheel" value="no">

&#1053;&#1077;&#1090;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="turning_car_wheel_age" type="text" size="3">

<br>

<strong>k.</strong> &#1055;&#1080;&#1089;&#1072;?

<input type="radio" name="typing" value="yes">

&#1044;&#1072;, &#1101;&#1090;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;

						  &nbsp;&nbsp;

                          <input type="radio" name="typing" value="no">

&#1053;&#1077;&#1090;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#1042; &#1082;&#1072;&#1082;&#1086;&#1084; &#1074;&#1086;&#1079;&#1088;&#1072;&#1089;&#1090;&#1077; &#1101;&#1090;&#1086; &#1089;&#1090;&#1072;&#1083;&#1086; &#1090;&#1088;&#1091;&#1076;&#1085;&#1086;?

<input name="typing_age" type="text" size="3">

                          </p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#1048;&#1089;&#1087;&#1099;&#1090;&#1099;&#1074;&#1072;&#1077;&#1090;&#1077; &#1083;&#1080; &#1074;&#1099; &#1089;&#1077;&#1088;&#1076;&#1077;&#1095;&#1085;&#1086;-&#1089;&#1086;&#1089;&#1091;&#1076;&#1080;&#1089;&#1090;&#1099;&#1077; &#1080;&#1083;&#1080; &#1076;&#1099;&#1093;&#1072;&#1090;&#1077;&#1083;&#1100;&#1085;&#1099;&#1077; &#1079;&#1072;&#1090;&#1088;&#1091;&#1076;&#1085;&#1077;&#1085;&#1080;&#1103;? </strong> &#1055;&#1086;&#1078;&#1072;&#1083;&#1091;&#1080;&#1089;&#1090;&#1072;, &#1086;&#1073;&#1098;&#1103;&#1089;&#1085;&#1080;&#1090;&#1077; &#1087;&#1086;&#1076;&#1088;&#1086;&#1073;&#1085;&#1077;&#1077;.<strong><br>

                          <textarea name="respiratory_difficulties" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

                     <tr>

                        <td bgcolor="#F3F9FA"><p class="form3"><strong>&#1057;&#1091;&#1097;&#1077;&#1089;&#1090;&#1074;&#1091;&#1102;&#1090; &#1083;&#1080; &#1092;&#1072;&#1082;&#1090;&#1086;&#1088;&#1099; (&#1090;&#1080;&#1087; &#1091;&#1087;&#1088;&#1072;&#1078;&#1085;&#1077;&#1085;&#1080;&#1081;, &#1076;&#1080;&#1077;&#1090;&#1072;, &#1072;&#1083;&#1082;&#1086;&#1075;&#1086;&#1083;&#1100;), &#1086;&#1073;&#1083;&#1077;&#1075;&#1095;&#1072;&#1102;&#1097;&#1080;&#1077; &#1074;&#1072;&#1096;&#1077; &#1089;&#1086;&#1089;&#1090;&#1086;&#1103;&#1085;&#1080;&#1077;? </strong> &#1055;&#1086;&#1078;&#1072;&#1083;&#1091;&#1080;&#1089;&#1090;&#1072;, &#1086;&#1073;&#1098;&#1103;&#1089;&#1085;&#1080;&#1090;&#1077; &#1087;&#1086;&#1076;&#1088;&#1086;&#1073;&#1085;&#1077;&#1077;.<strong><br>

                          <textarea name="factors_symptoms" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

					  <tr>

                        <td><p class="form3"><strong>&#1044;&#1086; &#1087;&#1086;&#1103;&#1074;&#1083;&#1077;&#1085;&#1080;&#1103; &#1089;&#1080;&#1084;&#1087;&#1090;&#1086;&#1084;&#1086;&#1074;, &#1074;&#1099; &#1095;&#1072;&#1089;&#1090;&#1086; &#1079;&#1072;&#1085;&#1080;&#1084;&#1072;&#1083;&#1080;&#1089;&#1100; &#1089;&#1087;&#1086;&#1088;&#1090;&#1086;&#1084;?</strong> &#1055;&#1086;&#1078;&#1072;&#1083;&#1091;&#1080;&#1089;&#1090;&#1072;, &#1086;&#1073;&#1098;&#1103;&#1089;&#1085;&#1080;&#1090;&#1077; &#1087;&#1086;&#1076;&#1088;&#1086;&#1073;&#1085;&#1077;&#1077;.<strong><br>

                          <textarea name="sports" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

					  <tr>

                        <td bgcolor="#F3F9FA"><p class="form3"><strong>&#1041;&#1086;&#1083;&#1077;&#1077;&#1090;&#1077; &#1083;&#1080; &#1074;&#1099; &#1090;&#1072;&#1082;&#1078;&#1077; &#1072;&#1091;&#1090;&#1086;&#1080;&#1084;&#1084;&#1091;&#1085;&#1085;&#1099;&#1084;&#1080; &#1080;&#1083;&#1080; &#1085;&#1077;&#1074;&#1088;&#1086;&#1083;&#1086;&#1075;&#1080;&#1095;&#1077;&#1089;&#1082;&#1080;&#1084;&#1080; &#1089;&#1086;&#1089;&#1090;&#1086;&#1103;&#1085;&#1080;&#1103;&#1084;&#1080; &#1080;&#1083;&#1080; &#1076;&#1080;&#1072;&#1073;&#1077;&#1090;&#1086;&#1084;? </strong><strong> </strong> &#1055;&#1086;&#1078;&#1072;&#1083;&#1091;&#1080;&#1089;&#1090;&#1072;, &#1086;&#1073;&#1098;&#1103;&#1089;&#1085;&#1080;&#1090;&#1077; &#1087;&#1086;&#1076;&#1088;&#1086;&#1073;&#1085;&#1077;&#1077;.<strong><br>

                          <textarea name="neurological" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

                      

                      <tr>

                        <td align="center" height="40">

<input type="submit" name="Submit" value=&#1042;&#1074;&#1086;&#1076;&nbsp;&#1044;&#1072;&#1085;&#1085;&#1099;&#1093;>&nbsp;&nbsp;&nbsp;

                          <input name="Reset" type="reset" id="Reset" value=&#1057;&#1073;&#1088;&#1086;&#1089;></td></tr>

                      

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



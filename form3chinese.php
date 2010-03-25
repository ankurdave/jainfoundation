<?

	session_start();

	if(isset($_SESSION['SESSION_ID'])){

		$login = true;
		include('includes/fixvars.php');

	}else{

		session_destroy();

		$login=false;

		include "form1chinese.php";

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

	?><script language="javascript">window.location="thankyouchinese.php";</script><?



}



?>

<html>

<head>

<title>Jain Foundation Inc | Patients | Registration Form Part 3</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="style-old.css" type="text/css" />

<style type="text/css">

<!--

.style3 {color: #0175C2;

	font-weight: bold;

}

.style4 {

	color: #990000;

	font-weight: bold;

}

-->

</style>

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

        <td><a href="index.php"><img src="images/logo_jain.gif" width="260" height="97" border="0"></a></td>

        <td><img src="images/logo_jain2.gif" width="520" height="97"></td>

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

			

				  <form name="registrant_3" method="post" action="form3chinese.php">

   <input type="hidden" name="action" value="save">

			

			<table width="94%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td valign="top" height="13"></td>

              </tr>

              <tr>

                <td valign="top"><p class="section">Patient Registration</p>

                    <p class="home"><span class="style3">&#30331;&#35352;&#34920;</span><br>

                      &#35531;&#32380;&#32396;&#24744;&#30340;&#35387;&#20874;; &#36889;&#37096;&#20998;&#22635;&#19981;&#22635;&#21487;&#33258;&#30001;&#36984;&#25799;&#12290;&#24744;&#25152;&#22635;&#19978;&#30340;&#36039;&#26009;&#23559;&#20445;&#35657;&#32085;&#23494;&#12290;<br>

                      <br>

                      <span class="style4">&#31532;&#19977;&#37096;&#20998;: &#30151;&#29376;&#36039;&#26009;</span><br>

                    </p>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#24744;&#31532;&#19968;&#27425;&#27880;&#24847;&#21040;&#30151;&#29376;&#26159;&#20160;&#40636;&#24180;&#40801;: 

                          <input name="age_symptoms" type="text" size="3">

                        </strong></p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#24744;&#20351;&#29992;&#20197;&#19979;&#30340;&#36628;&#21161;&#35373;&#20633;&#21966;?<br>

                          a.</strong> &#36650;&#26885;&#25110;&#38651;&#34892;&#36554;?

                          <input type="radio" name="scooter" value="always">

                          &#32317;&#26159;&#29992;&nbsp;&nbsp;

                          <input type="radio" name="scooter" value="sometimes">

                          &#26377;&#26178;&#29992;&nbsp;&nbsp;

                          <input type="radio" name="scooter" value="never">

                          &#24478;&#26410;&#29992;&#36942;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#24744;&#24478;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#29992;? 

						  <input name="scooter_age" type="text" size="3">

                          <br>

                          <strong>b</strong>.</strong> &#25296;&#26454;?

                          <input type="radio" name="cane" value="always">

                          &#32317;&#26159;&#29992;&nbsp;&nbsp;

                          <input type="radio" name="cane" value="sometimes">

                          &#26377;&#26178;&#29992;&nbsp;&nbsp;

                          <input type="radio" name="cane" value="never">

                          &#24478;&#26410;&#29992;&#36942;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#24744;&#24478;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#29992;? 

						  <input name="cane_age" type="text" size="3">

                          <br>

                          <strong>c.</strong></strong> &#33151;&#25903;&#26609;&#20855;?

                          <input type="radio" name="leg_braces" value="always">

                          &#32317;&#26159;&#29992;&nbsp;&nbsp;

                          <input type="radio" name="leg_braces" value="sometimes">

                          &#26377;&#26178;&#29992;&nbsp;&nbsp;

                          <input type="radio" name="leg_braces" value="never">

                          &#24478;&#26410;&#29992;&#36942;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#24744;&#24478;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#20351;&#29992;? 

						  <input name="leg_braces_age" type="text" size="3">

                         </p></td>

                      </tr>

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#27794;&#26377;&#38752;&#20219;&#20309;&#36628;&#21161;&#24744;&#33021;&#36208;&#22810;&#36960;?</strong><br>

									<input type="radio" name="walk_without_assistance" value="not at all">

									&#23436;&#20840;&#19981;&#33021;&nbsp;&nbsp;<input type="radio" name="walk_without_assistance" value="few steps only ">

									&#21482;&#33021;&#36208;&#24190;&#27493;&nbsp;&nbsp;<input type="radio" name="walk_without_assistance" value="across a room only">

									&#21482;&#33021;&#36208;&#19977;&#21040;&#22235;&#20844;&#23610;&nbsp;&nbsp;<input type="radio" name="walk_without_assistance" value="a block only">

									&#21482;&#33021;&#36208;&#19968;&#34903;&#21312;&nbsp;&nbsp;<input type="radio" name="walk_without_assistance" value="a mile or more">

									&#33021;&#36208;&#19968;&#20844;&#37324;&#21322;&#25110;&#26356;&#36960;</p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#27794;&#26377;&#38752;&#20219;&#20309;&#25903;&#25744;&#24744;&#21487;&#20197;&#31449;&#31435;&#22810;&#20037;?

                          <input name="stand_no_support" type="text">

                        </strong></p></td>

                      </tr>

                       <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#20197;&#19979;&#21508;&#38917;&#30446;, &#24744;&#26377;&#22256;&#38627;&#21966;?<br>

                          a.</strong> &#29992;&#33139;&#36286;&#23574;&#31449;&#26377;&#22256;&#38627;&#21966;?

                          <input type="radio" name="tiptoes" value="yes">

                          &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="tiptoes" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="tiptoes_age" type="text" size="3">

                          <br>

                          <strong>b</strong>.	&#24478;&#22352;&#30340;&#23039;&#21218;&#31449;&#36215;&#20358;&#26377;&#22256;&#38627;&#21966;?

                          <input type="radio" name="rising_sitting_position" value="yes">

                          &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="rising_sitting_position" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="rising_sitting_position_age" type="text" size="3">

                          <br>

						  &nbsp;&nbsp;&nbsp; &#24744;&#26377;&#20219;&#20309;&#26041;&#27861;&#21487;&#20197;&#25913;&#36914;&#36889;&#22256;&#38627;&#21966;? &#35531;&#35498;&#26126;&#12290;<br>

						  &nbsp;&nbsp;&nbsp;<textarea name="rising_sitting_position_explained" cols="40" rows="4"></textarea>

						  <br>

                          <strong>c.</strong> &#24478;&#36538;&#33879;&#30340;&#23039;&#21218;&#22352;&#36215;&#20358;&#26377;&#22256;&#38627;&#21966;?

                          <input type="radio" name="sitting_horizontal" value="yes">

                          &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="sitting_horizontal" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="sitting_horizontal_age" type="text" size="3">

                          <br>

						  <strong>d</strong>.	&#19978;&#27155;&#26799;&#26178;&#27794;&#38752;&#27396;&#26438;&#25110;&#20219;&#20309;&#25588;&#21161;&#26377;&#22256;&#38627;&#21966;? 

						  <input type="radio" name="climbing_stairs" value="yes">

						  &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="climbing_stairs" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="climbing_stairs_age" type="text" size="3">

                          <br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22914;&#26524;&#38752;&#27396;&#26438;&#25110;&#25296;&#26454;&#30340;&#25588;&#21161; &#24744;&#21487;&#20197;&#19978;&#27155;&#26799;&#21966;? &nbsp;&#35531;&#35498;&#26126;&#12290;<br>

						  &nbsp;&nbsp;&nbsp;<textarea name="climbing_stairs_explained" cols="40" rows="4"></textarea>

						  <br>

						  <strong>e.</strong> &#36208;&#19978;&#26012;&#22369;&#26377;&#22256;&#38627;&#21966;?

						  <input type="radio" name="elevation" value="yes">

						  &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="elevation" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="elevation_age" type="text" size="3">

                          <br>

						  <strong>f. </strong>&#25226;&#24744;&#30340;&#33011;&#33162;&#33289;&#36215;&#36229;&#36942;&#38957;&#19978;&#26377;&#22256;&#38627;&#21966;?

						  <input type="radio" name="raising_arm_above_head" value="yes">

						  &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="raising_arm_above_head" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp; &#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="raising_arm_above_head_age" type="text" size="3">

                          <br>

                          <strong>g. </strong>&#25343;&#36215;&#19968;&#26479;&#27700;&#26377;&#22256;&#38627;&#21966;?

                          <input type="radio" name="glass_of_water" value="yes">

                          &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="glass_of_water" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="glass_of_water_age" type="text" size="3">

                          <br>

						  <strong>h.</strong> &#25171;&#38283;&#19968;&#29942;&#26524;&#37292;&#26377;&#22256;&#38627;&#21966;?

						  <input type="radio" name="opening_jar" value="yes">

						  &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="opening_jar" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="opening_jar_age" type="text" size="3">

                          <br>

						  <strong>i. </strong>&#25163;&#25552;&#22235;&#20844;&#21319;&#37325;&#30340;&#29275;&#22902;&#24478;&#25151;&#38291;&#30340;&#19968;&#38957;&#36208;&#21040;&#21478;&#19968;&#38957;&#26377;&#22256;&#38627;&#21966;?

						  <input type="radio" name="carrying_milk" value="yes">

						  &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="carrying_milk" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="carrying_milk_age" type="text" size="3">

                          <br>

						  <strong>j. </strong>&#36681;&#21205;&#27773;&#36554;&#30340;&#39381;&#39387;&#30436;&#26377;&#22256;&#38627;&#21966;?

						  <input type="radio" name="turning_car_wheel" value="yes">

						  &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="turning_car_wheel" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="turning_car_wheel_age" type="text" size="3">

                          <br>

                          <strong>k.</strong> &#25171;&#23383;&#26377;&#22256;&#38627;&#21966;?

                          <input type="radio" name="typing" value="yes">

                          &#26159;, &#26377;&#22256;&#38627;&nbsp;&nbsp;

						  <input type="radio" name="typing" value="no">

						  &#27794;&#26377;&#22256;&#38627;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#40636;&#24180;&#40801;&#38283;&#22987;&#26377;&#22256;&#38627;? 

						  <input name="typing_age" type="text" size="3">

                          </p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#24744;&#26377;&#20219;&#20309;&#24515;&#33247;&#30149;&#25110;&#21628;&#21560;&#22256;&#38627;&#30340;&#29376;&#27841;&#21966;? &nbsp;</strong>&#35531;&#35498;&#26126;&#12290;<strong><br>

                          <textarea name="respiratory_difficulties" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

                     <tr>

                        <td bgcolor="#F3F9FA"><p class="form3"><strong>&#24744;&#26377;&#27794;&#26377;&#27880;&#24847;&#21040;&#20219;&#20309;&#23565;&#24744;&#30340;&#30151;&#29376;&#21487;&#25913;&#33391;&#25110;&#20419;&#36914;&#24801;&#21270;&#30340;&#22240;&#32032;&#21966; (&#20363;&#22914;&#39636;&#25805;, &#39154;&#39135;, &#39154;&#37202;)?  &nbsp;</strong>&#35531;&#35498;&#26126;&#12290;<strong><br>

                          <textarea name="factors_symptoms" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

					  <tr>

                        <td><p class="form3"><strong>&#22312;&#24744;&#30340;&#30151;&#29376;&#20986;&#29694;&#20043;&#21069; &#24744;&#24120;&#21443;&#21152;&#39636;&#32946;&#27963;&#21205;&#21966;? &nbsp;</strong>&#35531;&#35498;&#26126;&#12290;<strong><br>

                          <textarea name="sports" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

					  <tr>

                        <td bgcolor="#F3F9FA"><p class="form3"><strong>&#24744;&#26377;&#20854;&#20182;&#20219;&#20309;&#33258;&#21205;&#20813;&#30123;&#29376;&#24907;, &#25110;&#31070;&#32147;&#29376;&#24907;, &#25110;&#31958;&#23615;&#30149;&#21966;? &nbsp;</strong>&#35531;&#35498;&#26126;&#12290;<strong><br>

                          <textarea name="neurological" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

                      

                      <tr>

                        <td align="center" height="40"><input type="submit" name="Submit" value=&#25552;&#20132;>&nbsp;&nbsp;&nbsp;

                          <input name="Reset" type="reset" id="Reset" value=&#37325;&#26032;&#35373;&#23450;></td>

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



<?

	session_start();

	if(isset($_SESSION['SESSION_ID'])){

		$login = true;
		include('includes/fixvars.php');

	}else{

		session_destroy();

		$login=false;

		include "form1schinese.php";

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

	?><script language="javascript">window.location="thankyouschinese.php";</script><?



}



?>

<html>

<head>

<title>Jain Foundation Inc | Patients | Registration Form Part 3</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="style-old.css" type="text/css" />

</head>



<body leftmargin="0" topmargin="10" marginwidth="0" marginheight="10">

<table width="114%" height="100%" border="0" cellspacing="0" cellpadding="0">

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

			

				  <form name="registrant_3" method="post" action="form3schinese.php">

   <input type="hidden" name="action" value="save">

			

			<table width="94%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td valign="top" height="13"></td>

              </tr>

              <tr>

                <td valign="top"><p class="section">&#30331;&#35760;&#34920;</p>

                    <p class="home"> <strong><font color="#0175C2">&#30331;&#35760;&#34920;</font></strong><br>

  &#35831;&#32487;&#32493;&#24744;&#30340;&#27880;&#20876;&#65292;&#36825;&#37096;&#20998;&#21487;&#22635;&#21487;&#19981;&#22635;&#12290;.<br>

  <strong>&#24744;&#25152;&#22635;&#19978;&#30340;&#36164;&#26009;&#23558;&#34987;&#20445;&#23494;&#12290;</strong><br>

  <br>

  <strong><font color="#990000">&#31532;&#19977;&#37096;&#20998;&#65306;&#30151;&#29366;&#36164;&#26009;</font></strong>&#65288;&#21487;&#22635;&#21487;&#19981;&#22635;) </p>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#24744;&#31532;&#19968;&#27425;&#27880;&#24847;&#21040;&#30151;&#29366;&#26159;&#20160;&#20040;&#24180;&#40836;&#65311;

                          <input name="age_symptoms" type="text" size="3">

                        </strong></p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#24744;&#20351;&#29992;&#20197;&#19979;&#30340;&#36741;&#21161;&#35774;&#22791;&#21527;&#65311;<br>

a.</strong> &#36718;&#26885;&#25110;&#30005;&#21160;&#25705;&#25176;&#36710;&#65311;

<input type="radio" name="scooter" value="always">

&#24635;&#26159;&#29992;&nbsp;&nbsp;

<input type="radio" name="scooter" value="sometimes">

&#26377;&#26102;&#29992;&nbsp;&nbsp;

<input type="radio" name="scooter" value="never">

&#20174;&#26410;&#29992;&#36807;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#24744;&#20174;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#29992;&#65311;

<input name="scooter_age" type="text" size="3">

<br>

<strong>b</strong>.</strong> &#25296;&#26454;?

<input type="radio" name="cane" value="always">

&#24635;&#26159;&#29992;&nbsp;&nbsp;

<input type="radio" name="cane" value="sometimes">

&#26377;&#26102;&#29992;&nbsp;&nbsp;

<input type="radio" name="cane" value="never">

&#20174;&#26410;&#29992;&#36807;<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#24744;&#20174;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#29992;&#65311;

<input name="cane_age" type="text" size="3">

<br>

<strong>c.</strong></strong> &#33151;&#25903;&#26609;&#20855;

<input type="radio" name="leg_braces" value="always">

&#24635;&#26159;&#29992;&nbsp;&nbsp;

<input type="radio" name="leg_braces" value="sometimes">

&#26377;&#26102;&#29992;&nbsp;&nbsp;

<input type="radio" name="leg_braces" value="never">

&#20174;&#26410;&#29992;&#36807;<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#24744;&#20174;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#29992;&#65311;

<input name="leg_braces_age" type="text" size="3">

</p></td>

                      </tr>

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#27809;&#26377;&#38752;&#20219;&#20309;&#36741;&#21161;&#24744;&#33021;&#36208;&#22810;&#36828;&#65311; </strong><br>

                            <input type="radio" name="walk_without_assistance" value="not at all">

                            &#23436;&#20840;&#19981;&#33021; 

						  &nbsp;&nbsp;

						  <input type="radio" name="walk_without_assistance" value="few steps only ">

						  &#21482;&#33021;&#36208;&#20960;&#27493;

                          &nbsp;&nbsp;

                          <input type="radio" name="walk_without_assistance" value="across a room only">

                          &#21482;&#33021;&#31359;&#36807;&#19968;&#20010;&#25151;&#38388;<br>

						  <input type="radio" name="walk_without_assistance" value="a block only">

						  &#21482;&#33021;&#36208;&#19968;&#20010;&#34903;&#21306;

						  &nbsp;&nbsp;

						  <input type="radio" name="walk_without_assistance" value="a mile or more">

						  &#33021;&#36208;&#19968;&#20844;&#37324;&#21322;&#25110;&#26356;&#36828; </p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#27809;&#26377;&#38752;&#20219;&#20309;&#25903;&#25745;&#24744;&#21487;&#20197;&#31449;&#31435;&#22810;&#20037;&#65311;

                          <input name="stand_no_support" type="text">

                        </strong></p></td>

                      </tr>

                       <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#20197;&#19979;&#21508;&#39033;&#30446;&#65292;&#24744;&#26377;&#22256;&#38590;&#21527;&#65311;<br>

a.</strong> &#29992;&#33050;&#36286;&#23574;&#31449;&#65311;

<input type="radio" name="tiptoes" value="yes">

&#26377;&#22256;&#38590;

						  &nbsp;&nbsp;

                          <input type="radio" name="tiptoes" value="no">

&#27809;&#26377;&#22256;&#38590;<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="tiptoes_age" type="text" size="3">

<br>

<strong>b</strong>.	&#20174;&#22352;&#30340;&#23039;&#21183;&#31449;&#36215;&#26469;&#65311;

<input type="radio" name="rising_sitting_position" value="yes">

&#26377;&#22256;&#38590;

						  &nbsp;&nbsp;

                          <input type="radio" name="rising_sitting_position" value="no">

&#27809;&#26377;&#22256;&#38590;<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="rising_sitting_position_age" type="text" size="3">

<br>

&nbsp;&nbsp;&nbsp;&nbsp;&#24744;&#26377;&#20219;&#20309;&#26041;&#27861;&#21487;&#20197;&#25913;&#36827;&#36825;&#22256;&#38590;&#21527;(&#20363;&#22914;&#65306;&#35753;&#33258;&#24049;&#31449;&#36215;&#26469;) &#35831;&#35828;&#26126;

						  <br>&nbsp;&nbsp;&nbsp;

						  <textarea name="rising_sitting_position_explained" cols="40" rows="4"></textarea>

						  <br>

                          <strong>c.</strong> &#20174;&#36538;&#30528;&#30340;&#23039;&#21183;&#22352;&#36215;&#26469;&#26377;&#22256;&#38590;&#21527;?

                          <input type="radio" name="sitting_horizontal" value="yes">

&#26377;&#22256;&#38590;

						  &nbsp;&nbsp;

                          <input type="radio" name="sitting_horizontal" value="no">

&#27809;&#26377;&#22256;&#38590; <br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="sitting_horizontal_age" type="text" size="3">

<br>

<strong>d</strong>.	&#19978;&#27004;&#26799;&#26102;&#27809;&#38752;&#26639;&#26438;&#25110;&#20219;&#20309;&#25588;&#21161;&#65311;

<input type="radio" name="climbing_stairs" value="yes">

&#26377;&#22256;&#38590;&nbsp;&nbsp;

<input type="radio" name="climbing_stairs" value="no">

&#27809;&#26377;&#22256;&#38590;<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="climbing_stairs_age" type="text" size="3">

<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22914;&#26524;&#38752;&#26639;&#26438;&#25110;&#25296;&#26454;&#30340;&#25588;&#21161;&#24744;&#21487;&#20197;&#19978;&#27004;&#26799;&#21527;&#65311; &#35831;&#35828;&#26126;<br>

						  &nbsp;&nbsp;&nbsp;

						  <textarea name="climbing_stairs_explained" cols="40" rows="4"></textarea>

                          <br>

                          <strong>e.</strong> &#36208;&#19978;&#26012;&#22369;&#65311;

                          <input type="radio" name="elevation" value="yes">

&#26377;&#22256;&#38590;

						  &nbsp;&nbsp;

                          <input type="radio" name="elevation" value="no">

&#27809;&#26377;&#22256;&#38590; <br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="elevation_age" type="text" size="3">

<br>

<strong>f.</strong> &#25226;&#33011;&#33162;&#20030;&#36807;&#22836;&#39030;&#65311;

<input type="radio" name="raising_arm_above_head" value="yes">

&#26377;&#22256;&#38590;

						  &nbsp;&nbsp;

                          <input type="radio" name="raising_arm_above_head" value="no">

&#27809;&#26377;&#22256;&#38590; <br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="raising_arm_above_head_age" type="text" size="3">

<br>

<strong>g.</strong> &#20030;&#36215;&#19968;&#26479;&#27700;&#65311;

<input type="radio" name="glass_of_water" value="yes">

&#26377;&#22256;&#38590;&nbsp;&nbsp;

<input type="radio" name="glass_of_water" value="no">

&#27809;&#26377;&#22256;&#38590;<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="glass_of_water_age" type="text" size="3">

<br>

<strong>h.</strong> &#25171;&#24320;&#19968;&#29942;&#26524;&#37233;&#65311;

<input type="radio" name="opening_jar" value="yes">

&#26377;&#22256;&#38590;&nbsp;&nbsp;

<input type="radio" name="opening_jar" value="no">

&#27809;&#26377;&#22256;&#38590;<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="opening_jar_age" type="text" size="3">

<br>

<strong>i.</strong> &#25163;&#25552;&#22235;&#20844;&#21319;&#37325;&#30340;&#29275;&#22902;&#20174;&#25151;&#38388;&#30340;&#19968;&#22836;&#36208;&#21040;&#21478;&#19968;&#22836;&#65311;

<input type="radio" name="carrying_milk" value="yes">

&#26377;&#22256;&#38590;&nbsp;&nbsp;

<input type="radio" name="carrying_milk" value="no">

&#27809;&#26377;&#22256;&#38590;<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="carrying_milk_age" type="text" size="3">

<br>

<strong>j.</strong> &#36716;&#21160;&#27773;&#36710;&#30340;&#26041;&#21521;&#30424;&#65311;

<input type="radio" name="turning_car_wheel" value="yes">

&#26377;&#22256;&#38590;&nbsp;&nbsp;

<input type="radio" name="turning_car_wheel" value="no">

&#27809;&#26377;&#22256;&#38590;<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="turning_car_wheel_age" type="text" size="3">

<br>

<strong>k.</strong> &#25171;&#23383;&#65311;

<input type="radio" name="typing" value="yes">

&#26377;&#22256;&#38590;

						  &nbsp;&nbsp;

                          <input type="radio" name="typing" value="no">

&#27809;&#26377;&#22256;&#38590;<br>

&nbsp;&nbsp;&nbsp;&nbsp; &#22312;&#20160;&#20040;&#24180;&#40836;&#24320;&#22987;&#26377;&#22256;&#38590;&#65311;

<input name="typing_age" type="text" size="3">

</p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#24744;&#26377;&#20219;&#20309;&#24515;&#33039;&#25110;&#21628;&#21560;&#22256;&#38590;&#30340;&#30151;&#29366;&#21527;?</strong> &#35831;&#35828;&#26126;<strong><span class="form3">&#12290;</span><br>

                          <textarea name="respiratory_difficulties" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

                     <tr>

                        <td bgcolor="#F3F9FA"><p class="form3"><strong>&#24744;&#26377;&#27809;&#26377;&#27880;&#24847;&#21040;&#20219;&#20309;&#23545;&#24744;&#30340;&#30151;&#29366;&#21487;&#25913;&#36827;&#25110;&#24694;&#21270;&#30340;&#22240;&#32032;&#21527;&#65288;&#20363;&#22914;&#65306;&#20307;&#25805;&#65292;&#39278;&#39135;&#65292;&#39278;&#37202;&#65289;&#65311;</strong> &#35831;&#35828;&#26126;&#12290;.<strong><br>

                          <textarea name="factors_symptoms" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

					  <tr>

                        <td><p class="form3"><strong>&#22312;&#24744;&#30340;&#30151;&#29366;&#20986;&#29616;&#20043;&#21069;&#24744;&#24120;&#21442;&#21152;&#20307;&#32946;&#27963;&#21160;&#21527;&#65311; </strong>&#35831;&#35828;&#26126;&#12290;.<strong><br>

                          <textarea name="sports" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

					  <tr>

                        <td bgcolor="#F3F9FA"><p class="form3"><strong>&#24744;&#26377;&#20854;&#20182;&#20219;&#20309;&#33258;&#21160;&#20813;&#30123;&#29366;&#24577;&#65292;&#25110;&#31070;&#32463;&#29366;&#24577;&#65292;&#25110;&#31958;&#23615;&#30149;&#21527;&#65311;</strong><strong> </strong>&#35831;&#35828;&#26126;&#12290;<br>

                          <textarea name="neurological" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

                      

                      <tr>

                        <td align="center" height="40">

                          <input type="submit" name="Submit" value=&#25552;&#20132;>&nbsp;&nbsp;&nbsp;

                          <input name="Reset" type="reset" id="Reset" value=&#37325;&#26032;&#35774;&#23450;></td></tr>

                      

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



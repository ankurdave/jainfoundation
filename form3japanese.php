<?

	session_start();

	if(isset($_SESSION['SESSION_ID'])){

		$login = true;
		include('includes/fixvars.php');

	}else{

		session_destroy();

		$login=false;

		include "form1japanese.php";

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

	?><script language="javascript">window.location="thankyoujapanese.php";</script><?



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

			

				  <form name="registrant_3" method="post" action="form3japanese.php">

   <input type="hidden" name="action" value="save">

			

			<table width="94%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td valign="top" height="13"></td>

              </tr>

              <tr>

                <td valign="top"><p class="section">&#24739;&#32773;&#30331;&#37682;</p>

                    <p class="home"><strong><font color="#0175C2">&#30331;&#37682;&#12506;&#12540;&#12472;</font></strong><br>

                      &#30331;&#37682;&#25163;&#32154;&#12365;&#12434;&#32154;&#12369;&#12390;&#12367;&#12384;&#12373;&#12356;&#12290;&#12371;&#12398;&#27396;&#12398;&#35352;&#20837;&#12399;&#20219;&#24847;&#12391;&#12377;&#12290;<br>

                      <strong>&#35352;&#20837;&#12373;&#12428;&#12383;&#20840;&#12390;&#12398;&#24773;&#22577;&#12399;&#27231;&#23494;&#12395;&#20445;&#12383;&#12428;&#12414;&#12377;&#12290;</strong><br>

                      <br>

                      <strong><font color="#990000">&#31532;&#65299;&#37096;&#65306;&#30151;&#29366;&#12395;&#12388;&#12356;&#12390;&#12398;&#24773;&#22577;</font></strong> &#65288;&#35352;&#20837;&#12399;&#20219;&#24847;&#65289;<br>

                    </p>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#30151;&#29366;&#12395;&#21021;&#12417;&#12390;&#27671;&#12389;&#12356;&#12383;&#24180;&#40802;&#65306;

                          <input name="age_symptoms" type="text" size="3">

                        </strong></p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#20197;&#19979;&#12398;&#35036;&#21161;&#20855;&#12434;&#20351;&#29992;&#12373;&#12428;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311;<br>

                          a.</strong> &#36554;&#26885;&#23376;&#65311;

                          <input type="radio" name="scooter" value="always">

                          &#12356;&#12388;&#12418;&nbsp;&nbsp;

                          <input type="radio" name="scooter" value="sometimes">

                          &#26178;&#12293;&nbsp;&nbsp;

                          <input type="radio" name="scooter" value="never">

                          &#20351;&#12356;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#25165;&#12398;&#26178;&#12395;&#20351;&#12356;&#22987;&#12417;&#12414;&#12375;&#12383;&#12363;&#65311; 

						  <input name="scooter_age" type="text" size="3">

                          <br>

                          <strong>b.</strong></strong> &#26454;&#65311;

                          <input type="radio" name="cane" value="always">

                          &#12356;&#12388;&#12418;&nbsp;&nbsp;

                          <input type="radio" name="cane" value="sometimes">

                          &#26178;&#12293;&nbsp;&nbsp;

                          <input type="radio" name="cane" value="never">

                          &#20351;&#12356;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#25165;&#12398;&#26178;&#12395;&#20351;&#12356;&#22987;&#12417;&#12414;&#12375;&#12383;&#12363;&#65311;  

						  <input name="cane_age" type="text" size="3">

                          <br>

                          <strong>c.</strong></strong> &#12524;&#12483;&#12464;&#12502;&#12524;&#12540;&#12473;

                          <input type="radio" name="leg_braces" value="always">

                          &#12356;&#12388;&#12418;&nbsp;&nbsp;

                          <input type="radio" name="leg_braces" value="sometimes">

                          &#26178;&#12293;&nbsp;&nbsp;

                          <input type="radio" name="leg_braces" value="never">

                          &#20351;&#12356;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#25165;&#12398;&#26178;&#12395;&#20351;&#12356;&#22987;&#12417;&#12414;&#12375;&#12383;&#12363;&#65311;

						  <input name="leg_braces_age" type="text" size="3">

                         </p></td>

                      </tr>

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#21161;&#12369;&#12434;&#20511;&#12426;&#12378;&#12395;&#12393;&#12398;&#20301;&#27497;&#12369;&#12414;&#12377;&#12363;&#65311;</strong><br>

									<input type="radio" name="walk_without_assistance" value="not at all">

									&#20840;&#12367;&#27497;&#12369;&#12414;&#12379;&#12435;&nbsp;&nbsp;<input type="radio" name="walk_without_assistance" value="few steps only ">

									&#20108;&#19977;&#27497;&#12384;&#12369;&nbsp;&nbsp;<input type="radio" name="walk_without_assistance" value="across a room only">

									&#37096;&#23627;&#12434;&#27178;&#20999;&#12427;&#12384;&#12369;&nbsp;&nbsp;<input type="radio" name="walk_without_assistance" value="a block only">

									100 m

						  &nbsp;&nbsp;

						  <input type="radio" name="walk_without_assistance" value="a mile or more">

						  1-2 km</p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#21161;&#12369;&#12434;&#20511;&#12426;&#12378;&#12395;&#31435;&#12388;&#12371;&#12392;&#12364;&#12391;&#12365;&#12414;&#12377;&#12363;&#65311;

                          <input name="stand_no_support" type="text">

                        </strong></p></td>

                      </tr>

                       <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#20197;&#19979;&#12398;&#21205;&#20316;&#12395;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&#12363;&#65311;<br>

                          a.</strong> &#29226;&#20808;&#31435;&#12385;

                          <input type="radio" name="tiptoes" value="yes">

                          &#12399;&#12356;&#12289;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&nbsp;&nbsp;

						  <input type="radio" name="tiptoes" value="no">

						  &#21839;&#38988;&#12354;&#12426;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#27507;&#12398;&#38915;&#12395;&#21839;&#38988;&#12364;&#29983;&#12376;&#12414;&#12375;&#12383;&#12363;&#65311;

						  <input name="tiptoes_age" type="text" size="3">

                          <br>

                          <strong>b</strong>.	&#24231;&#12387;&#12383;&#29366;&#24907;&#12363;&#12425;&#31435;&#12385;&#19978;&#12364;&#12427;

                          <input type="radio" name="rising_sitting_position" value="yes">

&#12399;&#12356;&#12289;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&nbsp;&nbsp;

						  <input type="radio" name="rising_sitting_position" value="no">

						  &#21839;&#38988;&#12354;&#12426;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#27507;&#12398;&#38915;&#12395;&#21839;&#38988;&#12364;&#29983;&#12376;&#12414;&#12375;&#12383;&#12363;&#65311; 

						  <input name="rising_sitting_position_age" type="text" size="3">

                          <br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#12371;&#12398;&#21839;&#38988;&#12434;&#25913;&#21892;&#12377;&#12427;&#26041;&#27861;&#65288;&#20363;&#12360;&#12400;&#12289;&#20307;&#12434;&#25276;&#12375;&#19978;&#12370;&#12427;&#12371;&#12392;&#65289;&#12399;&#12354;&#12426;&#12414;&#12377;&#12363;&#65311;&#35500;&#26126;&#12375;&#12390;&#12367;&#12384;&#12373;&#12356;&#12290;<br>

						  &nbsp;&nbsp;&nbsp;<textarea name="rising_sitting_position_explained" cols="40" rows="4"></textarea>

						  <br>

                          <strong>c.</strong> &#23517;&#12383;&#29366;&#24907;&#12363;&#12425;&#19978;&#20307;&#12434;&#36215;&#12371;&#12377;

                          <input type="radio" name="sitting_horizontal" value="yes">

                          &#12399;&#12356;&#12289;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&#12290;&nbsp;&nbsp;

						  <input type="radio" name="sitting_horizontal" value="no">

						  &#21839;&#38988;&#12354;&#12426;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#27507;&#12398;&#38915;&#12395;&#21839;&#38988;&#12364;&#29983;&#12376;&#12414;&#12375;&#12383;&#12363;&#65311;

						  <input name="sitting_horizontal_age" type="text" size="3">

                          <br>

						  <strong>d</strong>.	&#38542;&#27573;&#12434;&#21161;&#12369;&#12420;&#25163;&#12377;&#12426;&#12394;&#12375;&#12395;&#30331;&#12427;&#65311;

						  <input type="radio" name="climbing_stairs" value="yes">

						  &#12399;&#12356;&#12289;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&nbsp;&nbsp;

						  <input type="radio" name="climbing_stairs" value="no">

						  &#21839;&#38988;&#12354;&#12426;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#27507;&#12398;&#38915;&#12395;&#21839;&#38988;&#12364;&#29983;&#12376;&#12414;&#12375;&#12383;&#12363;&#65311;

						  <input name="climbing_stairs_age" type="text" size="3">

                          <br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#38542;&#27573;&#12434;&#35036;&#21161;&#65288;&#26454;&#12420;&#25163;&#12377;&#12426;&#65289;&#12434;&#20351;&#12387;&#12390;&#30331;&#12427;&#12371;&#12392;&#12364;&#12391;&#12365;&#12414;&#12377;&#12363;&#65311;&#35500;&#26126;&#12375;&#12390;&#12367;&#12384;&#12373;&#12356;&#12290;<br>

						  &nbsp;&nbsp;&nbsp;<textarea name="climbing_stairs_explained" cols="40" rows="4"></textarea>

						  <br>

						  <strong>e.</strong> &#12422;&#12427;&#12356;&#19978;&#12426;&#22338;&#12434;&#30331;&#12427;

						  <input type="radio" name="elevation" value="yes">

&#12399;&#12356;&#12289;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&nbsp;&nbsp;

						  <input type="radio" name="elevation" value="no">

						  &#21839;&#38988;&#12354;&#12426;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#27507;&#12398;&#38915;&#12395;&#21839;&#38988;&#12364;&#29983;&#12376;&#12414;&#12375;&#12383;&#12363;&#65311;

						  <input name="elevation_age" type="text" size="3">

                          <br>

						  <strong>f.</strong> &#33109;&#12434;&#38957;&#12424;&#12426;&#19978;&#12395;&#12354;&#12370;&#12427;

						  <input type="radio" name="raising_arm_above_head" value="yes">

&#12399;&#12356;&#12289;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&nbsp;&nbsp;

						  <input type="radio" name="raising_arm_above_head" value="no">

&#21839;&#38988;&#12354;&#12426;&#12414;&#12379;&#12435; <br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#27507;&#12398;&#38915;&#12395;&#21839;&#38988;&#12364;&#29983;&#12376;&#12414;&#12375;&#12383;&#12363;&#65311;

						  <input name="raising_arm_above_head_age" type="text" size="3">

                          <br>

                          <strong>g.</strong> &#27700;&#12398;&#20837;&#12387;&#12383;&#12467;&#12483;&#12503;&#12434;&#25345;&#12385;&#19978;&#12370;&#12427;

                          <input type="radio" name="glass_of_water" value="yes">

&#12399;&#12356;&#12289;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&nbsp;&nbsp;

						  <input type="radio" name="glass_of_water" value="no">

&#21839;&#38988;&#12354;&#12426;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#27507;&#12398;&#38915;&#12395;&#21839;&#38988;&#12364;&#29983;&#12376;&#12414;&#12375;&#12383;&#12363;&#65311;

						  <input name="glass_of_water_age" type="text" size="3">

                          <br>

						  <strong>h.</strong> &#12472;&#12515;&#12512;&#12398;&#29942;&#12434;&#38283;&#12369;&#12427;

						  <input type="radio" name="opening_jar" value="yes">

&#12399;&#12356;&#12289;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&nbsp;&nbsp;

						  <input type="radio" name="opening_jar" value="no">

						  &#21839;&#38988;&#12354;&#12426;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#27507;&#12398;&#38915;&#12395;&#21839;&#38988;&#12364;&#29983;&#12376;&#12414;&#12375;&#12383;&#12363;&#65311;

						  <input name="opening_jar_age" type="text" size="3">

                          <br>

						  <strong>j.</strong> &#36554;&#12398;&#12495;&#12531;&#12489;&#12523;&#12434;&#12365;&#12427;&#12290;

						  <input type="radio" name="turning_car_wheel" value="yes">

&#12399;&#12356;&#12289;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&nbsp;&nbsp;

						  <input type="radio" name="turning_car_wheel" value="no">

						  &#21839;&#38988;&#12354;&#12426;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#27507;&#12398;&#38915;&#12395;&#21839;&#38988;&#12364;&#29983;&#12376;&#12414;&#12375;&#12383;&#12363;&#65311;

						  <input name="turning_car_wheel_age" type="text" size="3">

                          <br>

                          <strong>k.</strong> &#12461;&#12540;&#12508;&#12540;&#12489;&#12434;&#12479;&#12452;&#12503;&#12377;&#12427;&#65311;

                          <input type="radio" name="typing" value="yes">

                          &#12399;&#12356;&#12289;&#22256;&#38627;&#12434;&#24863;&#12376;&#12414;&#12377;&nbsp;&nbsp;

						  <input type="radio" name="typing" value="no">

						  &#21839;&#38988;&#12354;&#12426;&#12414;&#12379;&#12435;<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;&#20309;&#27507;&#12398;&#38915;&#12395;&#21839;&#38988;&#12364;&#29983;&#12376;&#12414;&#12375;&#12383;&#12363;&#65311;

						  <input name="typing_age" type="text" size="3">

                          </p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#24515;&#32954;&#27231;&#33021;&#12395;&#21839;&#38988;&#12399;&#12354;&#12426;&#12414;&#12377;&#12363;&#65311;</strong> &#35500;&#26126;&#12375;&#12390;&#12367;&#12384;&#12373;&#12356;<strong><br>

                          <textarea name="respiratory_difficulties" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

                     <tr>

                        <td bgcolor="#F3F9FA"><p class="form3"><strong>&#30151;&#29366;&#12434;&#24746;&#21270;&#12289;&#12418;&#12375;&#12367;&#12399;&#25913;&#21892;&#12377;&#12427;&#35201;&#22240;&#12395;&#27671;&#12364;&#12388;&#12365;&#12414;&#12375;&#12383;&#12363;&#65311;&#65288;&#20363;&#12289;&#36939;&#21205;&#12289;&#39135;&#20107;&#12289;&#12450;&#12523;&#12467;&#12540;&#12523;&#12394;&#12393;&#65289;</strong> &#35500;&#26126;&#12375;&#12390;&#12367;&#12384;&#12373;&#12356;<strong><br>

                          <textarea name="factors_symptoms" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

					  <tr>

                        <td><p class="form3"><strong>&#12473;&#12509;&#12540;&#12484;&#12420;&#36939;&#21205;&#12434;&#12375;&#12383;&#24460;&#12395;&#30151;&#29366;&#12364;&#29694;&#12428;&#12427;&#12371;&#12392;&#12399;&#12424;&#12367;&#12354;&#12426;&#12414;&#12377;&#12363;&#65311;</strong>&#35500;&#26126;&#12375;&#12390;&#12367;&#12384;&#12373;&#12356;&#12290;<strong><br>

                          <textarea name="sports" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

					  <tr>

                        <td bgcolor="#F3F9FA"><p class="form3"><strong>&#20182;&#12395;&#12289;&#33258;&#24049;&#20813;&#30123;&#30142;&#24739;&#12289;&#31070;&#32076;&#23398;&#30340;&#30142;&#24739;&#12289;&#31958;&#23615;&#30149;&#12394;&#12393;&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311;</strong><strong> </strong>&#35500;&#26126;&#12375;&#12390;&#12367;&#12384;&#12373;&#12356;<strong><br>

                          <textarea name="neurological" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

                      

                      <tr>

                        <td align="center" height="40"><input type="submit" name="Submit" value=&#30331;&#37682;&#12377;&#12427;>&nbsp;&nbsp;&nbsp;

                          <input name="Reset" type="reset" id="Reset" value=&#12522;&#12475;&#12483;&#12488;&#12377;&#12427;>

                          </td>

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



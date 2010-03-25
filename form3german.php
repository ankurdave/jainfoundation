<?

	session_start();

	if(isset($_SESSION['SESSION_ID'])){

		$login = true;
		include('includes/fixvars.php');

	}else{

		session_destroy();

		$login=false;

		include "form1german.php";

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

	?><script language="javascript">window.location="thankyougerman.php";</script><?



}



?>

<html>

<head>

<title>Jain Foundation Inc | Patients | Registration Form Part 3</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="style.css" type="text/css" />

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

			

				  <form name="registrant_3" method="post" action="form3german.php">

   <input type="hidden" name="action" value="save">

			

			<table width="94%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td valign="top" height="13"></td>

              </tr>

              <tr>

                <td valign="top"><p class="section">Patient Registration</p>

                    <p class="home"><strong><font color="#0175C2">Patientenregistrierung</font></strong><br>

Setzen Sie bitte Ihre Anmeldung fort; dieses Teil ist freiwillig. <br>

<strong><strong>ALLE IHRE INFORMATIONEN BLEIBEN VERTRAULICH</strong>.</strong><br>

                      <br>

                      <strong><font color="#990000">TEIL 3: SYMTOME</font></strong> (freiwillig)<br>

                    </p>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>Wie alt waren Sie bei ersten Symptomen? 

                              <input name="age_symptoms" type="text" size="3">

                        </strong></p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong> Benutzen Sie folgende Hilfsmittel?<br>

                          a.</strong> 	Rollstuhl

                          <input type="radio" name="scooter" value="always">Immer&nbsp;&nbsp;

                          <input type="radio" name="scooter" value="sometimes">Manchmal&nbsp;&nbsp;

                          <input type="radio" name="scooter" value="never">Nie<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="scooter_age" type="text" size="3">

                          <br>

                          <strong>b</strong>.</strong> 	Gehstock?

                          <input type="radio" name="cane" value="always">

                          Immer

                          &nbsp;&nbsp;

                          <input type="radio" name="cane" value="sometimes">Manchmal&nbsp;&nbsp;

                          <input type="radio" name="cane" value="never">Nie<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="cane_age" type="text" size="3">

                          <br>

                          <strong>c.</strong></strong> 	Bein-Orthesen

                          <input type="radio" name="leg_braces" value="always">

                          Immer

                          &nbsp;

                          <input type="radio" name="leg_braces" value="sometimes">Manchmal&nbsp;&nbsp;

                          <input type="radio" name="leg_braces" value="never">Nie<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="leg_braces_age" type="text" size="3">

                         </p></td>

                      </tr>

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>Wie weit können Sie ohne Unterstützung laufen?

                        </strong><br>

									<input type="radio" name="walk_without_assistance" value="not at all">

									Gar nicht 

						  &nbsp;&nbsp;

						  <input type="radio" name="walk_without_assistance" value="few steps only ">

						  Ein paar Schritte 

                          &nbsp;&nbsp;

                          <input type="radio" name="walk_without_assistance" value="across a room only">Im Zimmer

						  &nbsp;&nbsp;<input type="radio" name="walk_without_assistance" value="a block only">

						  100m

						  &nbsp;&nbsp;

						  <input type="radio" name="walk_without_assistance" value="a mile or more">

						  &gt;1km

						  </p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>Wie lange können Sie ohne Unterstützung stehen?

                              <input name="stand_no_support" type="text">

                        </strong></p></td>

                      </tr>

                       <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>Haben Sie Schwierigkeiten beim:<br>

                          a.</strong>	Stehen auf Zehenspitzen?

                          <input type="radio" name="tiptoes" value="yes">

                          Ja

						  &nbsp;&nbsp;

						  <input type="radio" name="tiptoes" value="no">

						  Nein<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="tiptoes_age" type="text" size="3">

                          <br>

                          <strong>b</strong>.	Aufstehen vom Sitzen?

                          <input type="radio" name="rising_sitting_position" value="yes">

                          Ja

						  &nbsp;&nbsp;

						  <input type="radio" name="rising_sitting_position" value="no">

						  Nein<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="rising_sitting_position_age" type="text" size="3">

                          <br>

						  &nbsp;&nbsp;&nbsp;Gibt es irgendeine Methode, die dieses verbessert (z.B. mit Ihren Armen sich hochdr&uuml;cken)? Bitte er<span class="form3">kl&auml;ren Sie</span>.<br>

						  &nbsp;&nbsp;&nbsp;<textarea name="rising_sitting_position_explained" cols="40" rows="4"></textarea>

						  <br>

                          <strong>c.</strong>	Aufsetzen vom Liegen?

                          <input type="radio" name="sitting_horizontal" value="yes">

                          Ja

						  &nbsp;&nbsp;

						  <input type="radio" name="sitting_horizontal" value="no">

						  Nein

                          <br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="sitting_horizontal_age" type="text" size="3">

                          <br>

						  <strong>d</strong>.	Treppensteigen? 

						  <input type="radio" name="climbing_stairs" value="yes">

						  Ja&nbsp;&nbsp;

						  <input type="radio" name="climbing_stairs" value="no">

						  Nein<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="climbing_stairs_age" type="text" size="3">

                          <br>

						  &nbsp;&nbsp;&nbsp;&nbsp;K&ouml;nnen Sie Treppe mit Hilfsmitteln  (z.B. Gel&auml;nder oder Gehstock) klettern?  Bitte er<span class="form3">kl&auml;ren Sie</span>.<br>

						  &nbsp;&nbsp;&nbsp;<textarea name="climbing_stairs_explained" cols="40" rows="4"></textarea>

						  <br>

						  <strong>e.</strong>	Gehen einer Steigung?     

						  <input type="radio" name="elevation" value="yes">

						  Ja

						  &nbsp;&nbsp;

						  <input type="radio" name="elevation" value="no">

						  Nein

                          <br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="elevation_age" type="text" size="3">

                          <br>

						  <strong>f.</strong>	Armheben?    

						  <input type="radio" name="raising_arm_above_head" value="yes">

						  Ja

						  &nbsp;&nbsp;

						  <input type="radio" name="raising_arm_above_head" value="no">

						  Nein

                          <br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="raising_arm_above_head_age" type="text" size="3">

                          <br>

                          <strong>g.</strong>	Ein Glass Wasser heben?     

                          <input type="radio" name="glass_of_water" value="yes">

                          Ja&nbsp;&nbsp;

						  <input type="radio" name="glass_of_water" value="no">

						  Nein<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="glass_of_water_age" type="text" size="3">

                          <br>

						  <strong>h.</strong>	Ein Marmeladeglas &ouml;ffnen?     

						  <input type="radio" name="opening_jar" value="yes">

						  Ja&nbsp;&nbsp;

						  <input type="radio" name="opening_jar" value="no">

						  Nein<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="opening_jar_age" type="text" size="3">

                          <br>

						  <strong>i.</strong>	Einkaufstasche tragen?     

						  <input type="radio" name="carrying_milk" value="yes">

						  Ja&nbsp;&nbsp;

						  <input type="radio" name="carrying_milk" value="no">

						  Nein<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="carrying_milk_age" type="text" size="3">

                          <br>

						  <strong>j.</strong>	Steuerrad im Auto bewegen?     

						  <input type="radio" name="turning_car_wheel" value="yes">

						  Ja&nbsp;&nbsp;

						  <input type="radio" name="turning_car_wheel" value="no">

						  Nein<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="turning_car_wheel_age" type="text" size="3">

                          <br>

                          <strong>k.</strong>	Schreibmaschine schreiben? 

                          <input type="radio" name="typing" value="yes">

                          Ja

						  &nbsp;&nbsp;

						  <input type="radio" name="typing" value="no">

						  Nein<br>

						  &nbsp;&nbsp;&nbsp;&nbsp;Seit welchem Alter? 

						  <input name="typing_age" type="text" size="3">

                          </p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>Haben Sie Probleme beim Atmen odor vom Herzen her?</strong> Bitte erklären Sie.<strong><br>

                          <textarea name="respiratory_difficulties" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

                     <tr>

                        <td bgcolor="#F3F9FA"><p class="form3"><strong>Haben Sie Umstände bemerkt, unter denen sich die Symptome verschlechtern  oder verbessern?</strong> Bitten erklären Sie.<strong><br>

                          <textarea name="factors_symptoms" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

					  <tr>

                        <td><p class="form3"><strong>Haben Sie früher viel Sport getrieben? </strong>Bitte erklären Sie.<strong><br>

                          <textarea name="sports" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

					  <tr>

                        <td bgcolor="#F3F9FA"><p class="form3"><strong> Haben Sie zusäzliche  Erkrankungen (insbesondere immunologische, Diabetes)?</strong><strong> </strong>Bitte erklären Sie.<strong><br>

                          <textarea name="neurological" cols="40" rows="4"></textarea>

                          

                        </strong></p></td>

                      </tr>

                      

                      <tr>

                        <td align="center" height="40"><input type="submit" name="Submit" value="Einreichen">&nbsp;&nbsp;&nbsp;

                          <input name="Reset" type="reset" id="Reset" value="Reset"></td>

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



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

		"mom_disease = '{$_REQUEST['mom_disease']}', " .

		"dad_disease = '{$_REQUEST['dad_disease']}', " .

		"relatives_name1 = '{$_REQUEST['relatives_name1']}', " .

		"relatives_age1 = '{$_REQUEST['relatives_age1']}', " .

		"relatives_LGMD2B1 = '{$_REQUEST['relatives_LGMD2B1']}', " .

		"relatives_name2 = '{$_REQUEST['relatives_name2']}', " .

		"relatives_age2 = '{$_REQUEST['relatives_age2']}', " .

		"relatives_LGMD2B2 = '{$_REQUEST['relatives_LGMD2B2']}', " .

		"relatives_name3 = '{$_REQUEST['relatives_name3']}', " .

		"relatives_age3 = '{$_REQUEST['relatives_age3']}', " .

		"relatives_LGMD2B3 = '{$_REQUEST['relatives_LGMD2B3']}', " .

		"relatives_name4 = '{$_REQUEST['relatives_name4']}', " .

		"relatives_age4 = '{$_REQUEST['relatives_age4']}', " .

		"relatives_LGMD2B4 = '{$_REQUEST['relatives_LGMD2B4']}', " .

		

		"children_name1 = '{$_REQUEST['children_name1']}', " .

		"children_age1 = '{$_REQUEST['children_age1']}', " .

		"children_LGMD2B1 = '{$_REQUEST['children_LGMD2B1']}', " .

		"children_name2 = '{$_REQUEST['children_name2']}', " .

		"children_age2 = '{$_REQUEST['children_age2']}', " .

		"children_LGMD2B2 = '{$_REQUEST['children_LGMD2B2']}', " .

		"children_name3 = '{$_REQUEST['children_name3']}', " .

		"children_age3 = '{$_REQUEST['children_age3']}', " .

		"children_LGMD2B3 = '{$_REQUEST['children_LGMD2B3']}', " .

		"children_name4 = '{$_REQUEST['children_name4']}', " .

		"children_age4 = '{$_REQUEST['children_age4']}', " .

		"children_LGMD2B4 = '{$_REQUEST['children_LGMD2B4']}', " .

		

		"sibling_name1 = '{$_REQUEST['sibling_name1']}', " .

		"sibling_age1 = '{$_REQUEST['sibling_age1']}', " .

		"sibling_LGMD2B1 = '{$_REQUEST['sibling_LGMD2B1']}', " .

		"sibling_name2 = '{$_REQUEST['sibling_name2']}', " .

		"sibling_age2 = '{$_REQUEST['sibling_age2']}', " .

		"sibling_LGMD2B2 = '{$_REQUEST['sibling_LGMD2B2']}', " .

		"sibling_name3 = '{$_REQUEST['sibling_name3']}', " .

		"sibling_age3 = '{$_REQUEST['sibling_age3']}', " .

		"sibling_LGMD2B3 = '{$_REQUEST['sibling_LGMD2B3']}', " .

		"sibling_name4 = '{$_REQUEST['sibling_name4']}', " .

		"sibling_age4 = '{$_REQUEST['sibling_age4']}', " .

		"sibling_LGMD2B4 = '{$_REQUEST['sibling_LGMD2B4']}' " .

		

  		"WHERE patient_id = " . $_SESSION['SESSION_ID'];

  

  //echo $sql;

  	$rs=mysql_query($sql); if (!$rs) {die('Error:' . mysql_error());}

	?><script language="javascript">window.location="form3japanese.php";</script><?



}



?>

<html>

<head>

<title>Jain Foundation Inc | Patients | Registration Form Part 2</title>

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

				  <form name="registrant_2" method="post" action="form2japanese.php" onSubmit="validate();">

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

<strong><font color="#990000">&#31532;&#65298;&#37096;&#65306;&#23478;&#26063;&#24773;&#22577;</font></strong>&#65288;&#35352;&#20837;&#12399;&#20219;&#24847;&#65289;<br>

                  </p>

                    

                 

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#12372;&#20001;&#35242;&#12398;&#12393;&#12385;&#12425;&#12363;&#12418;&#30149;&#27671;&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311;</strong><strong><br>

                          &#27597;&#35242;</strong>

                            <input type="radio" name="mom_disease" value="Yes">

                            &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="mom_disease" value="No">

                            &#12356;&#12356;&#12360;&nbsp;&nbsp;<br>

                            <strong>&#29238;&#35242;</strong>

                            <input type="radio" name="dad_disease" value="Yes">

                            &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="dad_disease" value="No">

                            &#12356;&#12356;&#12360;&nbsp;

                          </p></td>

                      </tr>

					  <tr>

                        <td><p class="form2"><strong>&#20804;&#24351;&#22985;&#22969;&#12399;&#12356;&#12425;&#12387;&#12375;&#12419;&#12356;&#12414;&#12377;&#12363;&#65311;</strong><br>

                          &#21517;&#21069;

                          <input name="sibling_name1" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802; 

                          <input name="sibling_age1" type="text" size="3">

                          &nbsp; &nbsp;LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311; 

                          <input type="radio" name="sibling_LGMD2B1" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="sibling_LGMD2B1" value="No">

                          &#12356;&#12356;&#12360;<br>

                          &#21517;&#21069;

                          <input name="sibling_name2" type="text" size="18">

                          &nbsp;&nbsp;&#21517;&#21069; 

                          <input name="sibling_age2" type="text" size="3">

                          &nbsp; &nbsp;LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311;

                          <input type="radio" name="sibling_LGMD2B2" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="sibling_LGMD2B2" value="No">

                          &#12356;&#12356;&#12360;<br>

                          &#21517;&#21069;

                          <input name="sibling_name3" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802; 

                          <input name="sibling_age3" type="text" size="3">

                          &nbsp; &nbsp;LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311; 

                          <input type="radio" name="sibling_LGMD2B3" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="sibling_LGMD2B3" value="No">

                          &#12356;&#12356;&#12360;<br>

                          &#21517;&#21069;

                          <input name="sibling_name4" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802; 

                          <input name="sibling_age4" type="text" size="3">

                          &nbsp; &nbsp;LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311; 

                          <input type="radio" name="sibling_LGMD2B4" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="sibling_LGMD2B4" value="No">

                          &#12356;&#12356;&#12360;</p></td>

                      </tr>

					  

					  <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#12362;&#23376;&#27096;&#12399;&#12362;&#25345;&#12385;&#12391;&#12377;&#12363;&#65311;</strong><br>

                          &#21517;&#21069;

                          <input name="children_name1" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802; 

                          <input name="children_age1" type="text" size="3">

                          &nbsp; &nbsp;LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311;

                          <input type="radio" name="children_LGMD2B1" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="children_LGMD2B1" value="No">

                          &#12356;&#12356;&#12360;<br>

                          &#21517;&#21069;

                          <input name="children_name2" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802; 

                          <input name="children_age2" type="text" size="3">

                          &nbsp;&nbsp; LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311; 

                          <input type="radio" name="children_LGMD2B2" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="children_LGMD2B2" value="No">

                          &#12356;&#12356;&#12360;<br>

                          &#21517;&#21069;

                          <input name="children_name3" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802; 

                          <input name="children_age3" type="text" size="3">

                          &nbsp; &nbsp;LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311;

                          <input type="radio" name="children_LGMD2B3" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="children_LGMD2B3" value="No">

                          &#12356;&#12356;&#12360;<br>

                          &#21517;&#21069;

                          <input name="children_name4" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802;

                          <input name="children_age4" type="text" size="3">

                          &nbsp;&nbsp; LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311;

                          <input type="radio" name="children_LGMD2B4" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="children_LGMD2B4" value="No">

                          &#12356;&#12356;&#12360;</p></td>

                      </tr>

					  

					  <tr>

                        <td><p class="form2"><strong>&#20182;&#12395;&#21516;&#12376;&#30149;&#27671;&#12395;&#12363;&#12363;&#12387;&#12383;&#35242;&#25114;&#12420;&#20808;&#31062;&#12399;&#12356;&#12425;&#12387;&#12375;&#12419;&#12356;&#12414;&#12377;&#12363;&#65311;</strong><br>

                          &#21517;&#21069;

                          <input name="relatives_name1" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802; 

                          <input name="relatives_age1" type="text" size="3">

                          &nbsp;&nbsp; LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311;

                          <input type="radio" name="relatives_LGMD2B1" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="relatives_LGMD2B1" value="No">

                          &#12356;&#12356;&#12360;<br>

                          &#21517;&#21069;

                          <input name="relatives_name2" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802; 

                          <input name="relatives_age2" type="text" size="3">

                          &nbsp;&nbsp; LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311; 

                          <input type="radio" name="relatives_LGMD2B2" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="relatives_LGMD2B2" value="No">

                          &#12356;&#12356;&#12360;<br>

                          &#21517;&#21069;

                          <input name="relatives_name3" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802; 

                          <input name="relatives_age3" type="text" size="3">

                          &nbsp;&nbsp; LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311; 

                          <input type="radio" name="relatives_LGMD2B3" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="relatives_LGMD2B3" value="No">

                          &#12356;&#12356;&#12360;<br>

                          &#21517;&#21069;

                          <input name="relatives_name4" type="text" size="18">

                          &nbsp;&nbsp;&#24180;&#40802;

                          <input name="relatives_age4" type="text" size="3">

                          &nbsp;&nbsp; LGMD2B&#12395;&#12363;&#12363;&#12387;&#12390;&#12356;&#12414;&#12377;&#12363;&#65311;

                          <input type="radio" name="relatives_LGMD2B4" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="relatives_LGMD2B4" value="No">

                          &#12356;&#12356;&#12360;</p></td>

                      </tr>

					  

                      <tr>

                        <td align="center" height="40"><input name="Continue" type="submit" id="Continue" value=&nbsp;&#27425;&#12395;&#36914;&#12416;>&nbsp;&nbsp;

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



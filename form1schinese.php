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

		

?><script language="javascript">window.location="form2schinese.php";</script><?



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

        <td><a href="index.php"><img src="images/logo_jain.gif" width="260" height="97" border="0"></a></td>

        <td><img src="images/logo_jain2.gif" width="520" height="97"></td>

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

			  <form name="registrant_1" method="post" action="form1schinese.php" onSubmit="return validate();">

  			 <input type="hidden" name="action" value="save">

			

			<table width="94%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td valign="top" height="13"></td>

              </tr>

              <tr>

                <td valign="top"><p class="section">&#30331;&#35760;&#34920;</p>

                    <p class="home"> <strong><font color="#0175C2">&#30331;&#35760;&#34920;</font></strong><br>

                      &#36825;&#24352;&#30331;&#35760;&#34920;&#20998;&#20026;&#19977;&#37096;&#20998;&#65292;&#22823;&#32422;&#38656;&#35201;15&#20998;&#38047;&#23601;&#21487;&#20197;&#23436;&#25104;&#12290;&#24744;&#30340;&#31572;&#22797;&#23545;&#20998;&#26512;&#36825;&#31181;&#30142;&#30149;&#22810;&#26041;&#38754;&#30340;&#21457;&#23637;&#20197;&#21450;&#20102;&#35299;&#36825;&#31181;&#32908;&#24102;&#22411;&#32908;&#33829;&#20859;&#19981;&#33391;&#30151;&#29366;&#65288;Limb-Girdle Muscular  Dystrophy&#65289;&#31181;&#31181;&#30340;&#29305;&#26377;&#24615;&#33021;&#26159;&#38750;&#24120;&#21487;&#36149;&#30340;&#12290;&#22240;&#27492;&#65292;&#21363;&#20351;&#26377;&#19968;&#20123;&#38382;&#39064;&#26159;&#20219;&#36873;&#30340;&#65292;&#35831;&#24744;&#23613;&#21487;&#33021;&#25226;&#36825;&#24352;&#30331;&#35760;&#34920;&#20840;&#37096;&#22635;&#19978;&#12290;&#36825;&#20010;&#32593;&#31449;&#26159;&#23433;&#20840;&#24182;&#19988;&#30001;SSL&#23494;&#30721;&#20445;&#25252;&#30340;&#12290;<br>

                      <strong>&#24744;&#25152;&#22635;&#19978;&#30340;&#36164;&#26009;&#23558;&#34987;&#20445;&#23494;&#12290;</strong>.<br>

                      <br>

&#22914;&#26524;&#24744;&#19981;&#24895;&#24847;&#22312;&#25105;&#20204;&#30340;&#32593;&#31449;&#30331;&#35760;&#65292;&#25105;&#20204;&#20173;&#28982;&#24076;&#26395;&#24744;&#24895;&#24847;&#29992;Plavi Mittal &#21338;&#22763;&#30340;&#30005;&#23376;&#37038;&#20214;<a href="mailto:plavimittal@jain-foundation.org">plavimittal@jain-foundation.org</a> &#19982;&#25105;&#20204;&#32852;&#31995;&#12290;<br><br>

<a href="form1.php"><img src="images/English.png" width="24" height="16" border="0"></a> <a href="form1.php" class="style1">English</a> &nbsp;&nbsp;&nbsp;<a href="form1spanish.php"><img src="images/Spanish.png" width="24" height="16" border="0"></a> <a href="form1spanish.php" class="style1">Espa&ntilde;ol</a> &nbsp;&nbsp;&nbsp;<a href="form1italian.php"><img src="images/Italian.png" width="24" height="16" border="0"></a> <a href="form1italian.php" class="style1">Italiano</a> &nbsp;&nbsp;&nbsp;<a href="form1dutch.php"><img src="images/Dutch.png" width="24" height="16" border="0"></a> <a href="form1dutch.php" class="style1">Nederlands</a> &nbsp;&nbsp;&nbsp;<a href="form1german.php"><img src="images/German.png" width="24" height="16" border="0"></a> <a href="form1german.php" class="style1">Deutsch</a> &nbsp;&nbsp;&nbsp;<br><br>

<a href="form1french.php"><img src="images/French.png" width="24" height="16" border="0"></a> <a href="form1french.php" class="style1">Fran&ccedil;ais</a> &nbsp;&nbsp;&nbsp;<a href="form1polish.php"><img src="images/Polish.png" width="24" height="16" border="0"></a> <a href="form1polish.php" class="style1">Polski</a> &nbsp;&nbsp;&nbsp;<a href="form1russian.php"><img src="images/Russian.png" width="24" height="16" border="0"></a> <A href="form1russian.php" class="style1">&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;</A> &nbsp;&nbsp;&nbsp;<a href="form1chinese.php"><img src="images/Chinese.png" width="24" height="16" border="0"></a> <a href="form1chinese.php" class="style1">&#27491;&#39636;&#23383;/&#32321;&#39636;&#23383;</a> &nbsp;&nbsp;&nbsp;<a href="form1schinese.php"><img src="images/SChinese.png" width="24" height="16" border="0"></a> <a href="form1schinese.php" class="style1"><SPAN lang="zh-Hans" xml:lang="zh-Hans">&#31616;&#20307;&#23383;</SPAN>/<SPAN lang="zh-Hans" xml:lang="zh-Hans">&#31616;&#21270;&#23383;</SPAN></a> <br><br>

<a href="form1japanese.php"><img src="images/Japanese.png" width="24" height="16" border="0"></a> <a href="form1japanese.php" class="style1"><SPAN lang="ja" xml:lang="ja">&#26085;&#26412;&#35486;</SPAN></a><br>

<br>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript" SRC="//smarticon.geotrust.com/si.js"></SCRIPT><br><br>

<strong><font color="#990000">&#31532;&#19968;&#37096;&#20998;&#65306;&#22522;&#26412;&#36164;&#26009;</font></strong><br><br>

</p>

                    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">

                      <tr bgcolor="#F3F9FA">

                        <td width="30%"><p class="form">&#21517;</p></td>

                        <td bgcolor="#F3F9FA"><input name="firstName" type="text" id="firstName" maxlength="50"></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#22995;</p></td>

                        <td><input name="lastName" type="text" id="lastName" maxlength="50"></td>

                      </tr>

                      <tr bgcolor="#F3F9FA">

                       <td bgcolor="#F3F9FA"><p class="form">&#30005;&#23376;&#37038;&#20214;</p></td>

                        <td><input name="email" type="text" id="email" maxlength="50"></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#30005;&#35805;&#21495;&#30721;&#65288;&#21487;&#22635;&#25110;&#19981;&#22635;&#65289;</p></td>

                        <td><input name="phone" type="text" id="phone" maxlength="50"></td>

                      </tr>

                      <tr bgcolor="#F3F9FA">

                        <td><p class="form">&#22320;&#22336;&#65288;&#21487;&#22635;&#25110;&#19981;&#22635;&#65289;</p></td>

                        <td><input name="address" type="text" id="address" maxlength="50"></td>

                      </tr>

                      <tr>

                        <td><p class="form">&#24066;/&#24030;&#65288;&#30465;&#65289;/&#37038;&#25919;&#20195;&#30721;</p></td>

                        <td><input name="cityStateZip" type="text" id="cityStateZip" maxlength="50"></td>

                      </tr>

					  <tr bgcolor="#F3F9FA">

                        <td width="30%"><p class="form">&#22269;&#23478;&#65288;&#35831;&#36873;&#19968;&#65289;</p></td>

                        <td><? countries(); ?></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#24615;&#21035;</p></td>

                        <td><select name="gender" id="gender">

                          <option>&#35831;&#36873;&#19968;</option>

                          <option>&#30007;</option>

                          <option>&#22899;</option>                

                            </select></td>

                      </tr>

                      <tr bgcolor="#F3F9FA">

                       <td bgcolor="#F3F9FA"><p class="form">&#24180;&#40836;</p></td>

                        <td bgcolor="#F3F9FA"><input name="currentAge" type="text" id="currentAge" size="3" maxlength="3"></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#35786;&#26029;&#26102;&#20505;&#30340;&#24180;&#40836;</p></td>

                        <td><input name="diagnosisAge" type="text" id="diagnosisAge" size="3" maxlength="3"></td>

                      </tr>

                    </table>

                 

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td height="10"></td>

                      </tr>

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#24744;&#30340;&#30149;&#24773;&#26159;&#24590;&#20040;&#35786;&#26029;&#25110;&#35777;&#23454;&#30340;:<br>

                          a. </strong>&#20973;&#36523;&#20307;&#26816;&#26597;&#21527;&#65311;

                          <input type="radio" name="diagnosis_examination" value="Yes">

                          &#26159;&nbsp;&nbsp;<input type="radio" name="diagnosis_examination" value="No">

                          &#19981;&#26159;&nbsp;&nbsp;<input type="radio" name="diagnosis_examination" value="Not Sure">

                          &#19981;&#32943;&#23450;<br>

                          <strong>b</strong>.	&#20973;&#27979;&#39564;&#32908;&#37240;&#37238;&#30340;&#39640;&#24230;&#21527;&#65311; 

                          <input type="radio" name="diagnosis_CK_level" value="Yes">

                          &#26159;&nbsp;&nbsp;<input type="radio" name="diagnosis_CK_level" value="No">

                          &#19981;&#26159;&nbsp;&nbsp;<input type="radio" name="diagnosis_CK_level" value="Not Sure">

                          &#19981;&#32943;&#23450;&nbsp;&nbsp;<br>

                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#22914;&#26524;&#24744;&#26377;&#36825;&#20010;&#36164;&#26009;&#65292;&#24744;&#35786;&#26029;&#26102;&#30340;&#32908;&#37240;&#28608;&#37238;&#39640;&#24230;&#26159;&#20160;&#20040;&#65311;

                          <input name="diagnosis_CK_level_number" type="text" size="3" maxlength="8">

                          <br>

                          <strong>c.</strong> &#20973;&#32908;&#32905;&#20999;&#29255;&#30340;&#26816;&#39564;&#21527;?

                          <input type="radio" name="diagonsis_muscle_biopsy" value="Yes">

                          &#26159;&nbsp;&nbsp;<input type="radio" name="diagonsis_muscle_biopsy" value="No">

                          &#19981;&#26159;&nbsp;&nbsp;<input type="radio" name="diagonsis_muscle_biopsy" value="Not Sure">

                          &#19981;&#32943;&#23450;<br>

                          <strong>d.</strong> &#20973;&#34880;&#32454;&#32990;&#65288;&#21333;&#26680;&#32454;&#32990;&#65289;&#30340;&#26816;&#39564;&#21527;&#65311; 

                          &nbsp;&nbsp;

                          <input type="radio" name="diagnosis_blood_cell_test" value="Yes">

                          &#26159;&nbsp;&nbsp;<input type="radio" name="diagnosis_blood_cell_test" value="No">

                          &#19981;&#26159;&nbsp;&nbsp;<input type="radio" name="diagnosis_blood_cell_test" value="Not Sure">

                          &#19981;&#32943;&#23450; <br>

                          <strong>e.</strong> &#20973;&#21435;[&#33073;]&#27687;&#31958;&#26680;&#37240;&#30340;&#20998;&#26512;&#26816;&#39564;&#21527;&#65311;

                          <input type="radio" name="diagnosis_mutational" value="Yes">

                          &#26159;&nbsp;&nbsp;<input type="radio" name="diagnosis_mutational" value="No">

                          &#19981;&#26159;&nbsp;&nbsp;<input type="radio" name="diagnosis_mutational" value="Not Sure">

                          &#19981;&#32943;&#23450;</p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#25552;&#20132;&#26085;&#26399;

                          <input name="submission_date" type="text" value="<?=$myDate;?>" size="10" maxlength="50">

                        </strong></p></td>

                      </tr>

                      <tr>

                        <td align="center" height="40"><input  name="Continue" type="submit" id="Continue" value=&#32487;&#32493;>&nbsp;&nbsp;&nbsp;

                          <input name="Reset" type="reset" id="Reset" value=&#37325;&#26032;&#35774;&#23450;></td>

                      </tr>

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



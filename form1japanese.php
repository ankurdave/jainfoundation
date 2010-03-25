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

		

?><script language="javascript">window.location="form2japanese.php";</script><?



}

?>

<html>

<head>

<title>Jain Foundation Inc | Patients | Registration Form Part 1</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="style.css" type="text/css" />

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

			  <form name="registrant_1" method="post" action="form1japanese.php" onSubmit="return validate();">

  			 <input type="hidden" name="action" value="save">

			

			<table width="94%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td valign="top" height="13"></td>

              </tr>

              <tr>

                <td valign="top"><p class="section">&#24739;&#32773;&#30331;&#37682;</p>

                    <p class="home"><strong><font color="#0175C2">&#30331;&#37682;&#12506;&#12540;&#12472;</font></strong><br>

                      &#12371;&#12398;&#30331;&#37682;&#12506;&#12540;&#12472;&#12399;&#65299;&#12388;&#12398;&#37096;&#20998;&#12363;&#12425;&#25104;&#12426;&#12289;&#35352;&#20837;&#12395;&#65297;&#65301;&#20998;&#12411;&#12393;&#12363;&#12363;&#12426;&#12414;&#12377;&#12290;&#30331;&#37682;&#12373;&#12428;&#12427;&#12371;&#12392;&#12399;&#12289;&#12371;&#12398;&#30149;&#27671;&#12398;&#36914;&#34892;&#12392;&#12371;&#12398;&#12479;&#12452;&#12503;&#12398;LGMD&#29305;&#26377;&#12398;&#24615;&#36074;&#12434;&#29702;&#35299;&#12377;&#12427;&#12383;&#12417;&#12398;&#36020;&#37325;&#12394;&#21161;&#12369;&#12395;&#12394;&#12426;&#12414;&#12377;&#12290;&#22238;&#31572;&#12364;&#24517;&#38920;&#12391;&#12394;&#12356;&#36074;&#21839;&#12418;&#12354;&#12426;&#12414;&#12377;&#12364;&#12289;&#12391;&#12365;&#12427;&#12384;&#12369;&#20840;&#12390;&#12398;&#24773;&#22577;&#12398;&#12372;&#35352;&#20837;&#12434;&#12372;&#32771;&#24942;&#39000;&#12356;&#12414;&#12377;&#12290;&#12371;&#12398;&#12454;&#12455;&#12502;&#12469;&#12452;&#12488;&#12395;&#35352;&#20837;&#12373;&#12428;&#12383;&#24773;&#22577;&#12399;SSL&#12395;&#12424;&#12387;&#12390;&#26263;&#21495;&#21270;&#12373;&#12428;&#20445;&#35703;&#12373;&#12428;&#12414;&#12377;&#12290;<strong>&#20840;&#12390;&#12398;&#24773;&#22577;&#12399;&#27231;&#23494;&#12395;&#20445;&#12383;&#12428;&#12414;&#12377;</strong><br>

                      <br>

                      &#12371;&#12398;&#12454;&#12455;&#12502;&#12469;&#12452;&#12488;&#12391;&#12398;&#30331;&#37682;&#12434;&#24076;&#26395;&#12375;&#12394;&#12356;&#22580;&#21512;&#12418;&#12289;&#12380;&#12402;&#24773;&#22577;&#12289;&#12372;&#24847;&#35211;&#12434;&#12362;&#32862;&#12363;&#12379;&#12367;&#12384;&#12373;&#12356;&#12290;E&#12513;&#12540;&#12523;&#12391;&#12503;&#12521;&#12532;&#12451;&#12539;&#12511;&#12483;&#12479;&#12523;&#21338;&#22763;&#12395;&#12372;&#36899;&#32097;&#12434;&#12362;&#39000;&#12356;&#12375;&#12414;&#12377;&#12290;<a href="mailto:plavimittal@jain-foundation.org">plavimittal@jain-foundation.org</a> <br><br>

<a href="form1.php"><img src="images/English.png" width="24" height="16" border="0"></a> <a href="form1.php" class="style1">English</a> &nbsp;&nbsp;&nbsp;<a href="form1spanish.php"><img src="images/Spanish.png" width="24" height="16" border="0"></a> <a href="form1spanish.php" class="style1">Espa&ntilde;ol</a> &nbsp;&nbsp;&nbsp;<a href="form1italian.php"><img src="images/Italian.png" width="24" height="16" border="0"></a> <a href="form1italian.php" class="style1">Italiano</a> &nbsp;&nbsp;&nbsp;<a href="form1dutch.php"><img src="images/Dutch.png" width="24" height="16" border="0"></a> <a href="form1dutch.php" class="style1">Nederlands</a> &nbsp;&nbsp;&nbsp;<a href="form1german.php"><img src="images/German.png" width="24" height="16" border="0"></a> <a href="form1german.php" class="style1">Deutsch</a> &nbsp;&nbsp;&nbsp;<br><br>

<a href="form1french.php"><img src="images/French.png" width="24" height="16" border="0"></a> <a href="form1french.php" class="style1">Fran&ccedil;ais</a> &nbsp;&nbsp;&nbsp;<a href="form1polish.php"><img src="images/Polish.png" width="24" height="16" border="0"></a> <a href="form1polish.php" class="style1">Polski</a> &nbsp;&nbsp;&nbsp;<a href="form1russian.php"><img src="images/Russian.png" width="24" height="16" border="0"></a> <A href="form1russian.php" class="style1">&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;</A> &nbsp;&nbsp;&nbsp;<a href="form1chinese.php"><img src="images/Chinese.png" width="24" height="16" border="0"></a> <a href="form1chinese.php" class="style1">&#27491;&#39636;&#23383;/&#32321;&#39636;&#23383;</a> &nbsp;&nbsp;&nbsp;<a href="form1schinese.php"><img src="images/SChinese.png" width="24" height="16" border="0"></a> <a href="form1schinese.php" class="style1"><SPAN lang="zh-Hans" xml:lang="zh-Hans">&#31616;&#20307;&#23383;</SPAN>/<SPAN lang="zh-Hans" xml:lang="zh-Hans">&#31616;&#21270;&#23383;</SPAN></a><br><br>

<a href="form1japanese.php"><img src="images/Japanese.png" width="24" height="16" border="0"></a> <a href="form1japanese.php" class="style1"><SPAN lang="ja" xml:lang="ja">&#26085;&#26412;&#35486;</SPAN></a> <br>

<br>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript" SRC="//smarticon.geotrust.com/si.js"></SCRIPT><br>

<br>

<strong><font color="#990000">&#31532;&#65297;&#37096;&#65306;&#22522;&#26412;&#24773;&#22577;</font></strong><br><br>

</p>

                    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">

                      <tr bgcolor="#F3F9FA">

                        <td width="30%"><p class="form">&#21517;&#21069;</p></td>

                        <td bgcolor="#F3F9FA"><input name="firstName" type="text" id="firstName" maxlength="50"></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#33495;&#23383;</p></td>

                        <td><input name="lastName" type="text" id="lastName" maxlength="50"></td>

                      </tr>

                      <tr bgcolor="#F3F9FA">

                       <td bgcolor="#F3F9FA"><p class="form">E&#12513;&#12540;&#12523;</p></td>

                        <td><input name="email" type="text" id="email" maxlength="50"></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#38651;&#35441;&#65288;&#35352;&#20837;&#12399;&#20219;&#24847;&#65289;</p></td>

                        <td><input name="phone" type="text" id="phone" maxlength="50"></td>

                      </tr>

                      <tr bgcolor="#F3F9FA">

                        <td><p class="form">&#37109;&#20415;&#30058;&#21495; 1</p></td>

                        <td><input name="address" type="text" id="address" maxlength="50"></td>

                      </tr>

                      <tr>

                        <td><p class="form">&#37109;&#20415;&#30058;&#21495; 2</p></td>

                        <td><input name="cityStateZip" type="text" id="cityStateZip" maxlength="50"></td>

                      </tr>

					  <tr bgcolor="#F3F9FA">

                        <td width="30%"><p class="form">&#22269;</p></td>

                        <td><? countries(); ?></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#24615;&#21029;</p></td>

                        <td><select name="gender" id="gender">

                          <option selected>&#19979;&#12363;&#12425;&#36984;&#25246;</option>

                          <option>&#30007;&#24615;</option>

                          <option>&#22899;&#24615;</option>                

                            </select>

 </td>

                      </tr>

                      <tr bgcolor="#F3F9FA">

                       <td bgcolor="#F3F9FA"><p class="form">&#24180;&#40802;</p></td>

                        <td bgcolor="#F3F9FA"><input name="currentAge" type="text" id="currentAge" size="3" maxlength="3"></td>

                      </tr>

                      <tr>

                       <td><p class="form">&#35386;&#26029;&#12434;&#21463;&#12369;&#12383;&#38555;&#12398;&#24180;&#40802;</p></td>

                        <td><input name="diagnosisAge" type="text" id="diagnosisAge" size="3" maxlength="3"></td>

                      </tr>

                    </table>

                 

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td height="10"></td>

                      </tr>

                      <tr>

                        <td bgcolor="#F3F9FA"><p class="form2"><strong>&#35386;&#26029;&#12399;&#20197;&#19979;&#12398;&#26908;&#26619;&#12395;&#12424;&#12387;&#12390;&#12394;&#12373;&#12428;&#12289;&#12418;&#12375;&#12367;&#12399;&#30906;&#35469;&#12373;&#12428;&#12414;&#12375;&#12383;&#12363;&#65311;<br>

                          a.</strong> &#36523;&#20307;&#26908;&#26619;

                          <input type="radio" name="diagnosis_examination" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="diagnosis_examination" value="No">

                          &#12356;&#12356;&#12360;&nbsp;&nbsp;<input type="radio" name="diagnosis_examination" value="Not Sure">

                          &#12431;&#12363;&#12426;&#12414;&#12379;&#12435;<br>

                          <strong>b</strong>.	CK &#65288;&#12463;&#12524;&#12450;&#12481;&#12531;&#12461;&#12490;&#12540;&#12476;&#65289;&#12398;&#20516;&#65311; 

                          <input type="radio" name="diagnosis_CK_level" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="diagnosis_CK_level" value="No">

                          &#12356;&#12356;&#12360;&nbsp;&nbsp;<input type="radio" name="diagnosis_CK_level" value="Not Sure">

                          &#12431;&#12363;&#12426;&#12414;&#12379;&#12435;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          &#12418;&#12375;&#12372;&#23384;&#30693;&#12394;&#12425;&#12400;&#12289;&#35386;&#26029;&#12398;&#38555;&#12398;CK&#12398;&#20516;&#12399;&#12356;&#12367;&#12388;&#12391;&#12375;&#12383;&#12363;&#65311;

                          <input name="diagnosis_CK_level_number" type="text" size="3" maxlength="8">

                          <br>

                          <strong>c.</strong> &#31563;&#12496;&#12452;&#12458;&#12503;&#12471;&#12540;&#65311;

                          <input type="radio" name="diagonsis_muscle_biopsy" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="diagonsis_muscle_biopsy" value="No">

                          &#12356;&#12356;&#12360;&nbsp;&nbsp;<input type="radio" name="diagonsis_muscle_biopsy" value="Not Sure">

                          &#12431;&#12363;&#12426;&#12414;&#12379;&#12435;<br>

                          <strong>d.</strong> &#34880;&#29699;&#65288;&#21336;&#29699;&#65289;&#12398;&#12486;&#12473;&#12488;&#65311;

                          <input type="radio" name="diagnosis_blood_cell_test" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="diagnosis_blood_cell_test" value="No">

                          &#12356;&#12356;&#12360;&nbsp;&nbsp;<input type="radio" name="diagnosis_blood_cell_test" value="Not Sure">

                          &#12431;&#12363;&#12426;&#12414;&#12379;&#12435;<br>

                          <strong>e.</strong> &#31361;&#28982;&#22793;&#30064;&#12398;&#35299;&#26512;&#65288;DNA&#12471;&#12540;&#12463;&#12456;&#12531;&#12471;&#12531;&#12464;&#65289;

                          <input type="radio" name="diagnosis_mutational" value="Yes">

                          &#12399;&#12356;&nbsp;&nbsp;<input type="radio" name="diagnosis_mutational" value="No">

                          &#12356;&#12356;&#12360;&nbsp;&nbsp;<input type="radio" name="diagnosis_mutational" value="Not Sure">

                          &#12431;&#12363;&#12426;&#12414;&#12379;&#12435;</p></td>

                      </tr>

                      <tr>

                        <td><p class="form2"><strong>&#35352;&#20837;&#24180;&#26376;&#26085;

                          <input name="submission_date" type="text" value="<?=$myDate;?>" size="10" maxlength="50">

                        </strong></p></td>

                      </tr>

                      <tr>

                        <td align="center" height="40"><input  name="Continue" type="submit" id="Continue" value=&#27425;&#12395;&#36914;&#12416;>&nbsp;&nbsp;&nbsp;

                          <input name="Reset" type="reset" id="Reset" value=&#12522;&#12475;&#12483;&#12488;&#12377;&#12427;></td>

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



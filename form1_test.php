<? 
session_start();
include('includes/fixvars.php');

if(@$_REQUEST["action"]=="checkValue")
{
	$agree = $_REQUEST["agree"];
	$disagree = $_REQUEST["disagree"];
		
		if ($agree) {
			?><script language="javascript">window.location="form1english.php";</script><?
		}elseif($disagree){
			?><script language="javascript">window.location="disagree.php";</script><?
		}else{
			?><script language="javascript">window.location="form1_test.php";</script><?
		}
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

<script language="javascript">
<!--
function validate()
{  
	var agree = registrant_1.agree.checked;
	var disagree = registrant_1.disagree.checked;

	if(agree == true && disagree == true){
		alert("You must check either AGREE or DISAGREE to proceed.");
		return false;	
	}
	
	if(agree == false && disagree == false){
		alert("You must check either AGREE or DISAGREE to proceed.");
		return false;	
	}

return true;

}
//-->
</script>

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

                  <td bgcolor="#FEFFD7"><p class="leftNav">&raquo; <a href="form1.php" class="leftnav">Registration

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
			 <form name="registrant_1" method="post" action="form1_test.php" onSubmit="return validate();">
  			 <input type="hidden" name="action" value="checkValue">	

			<table width="94%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td valign="top" height="13"></td>

              </tr>

              <tr>

                <td valign="top"><p class="section">Patient Registration</p>

                    <p class="home"> <strong><font color="#0175C2">Privacy Notice
                          and Authorization</font></strong><br>

                          By registering in the LGMD2B/Miyoshi screening database,
                          maintained by the Jain Foundation Inc, you will be
                          providing us with certain individually-identifiable
                          healthcare information. The privacy of this information
                          is protected under various federal, state and international
                          laws, including the Health Insurance Portability and
                          Accountability Act (HIPAA) in the United States. <br><br>
                          Although the Jain Foundation is not a provider of healthcare,
                          we want you to know that we hold your individually
                          identifiable information in the strictest of confidence,
                          and will only use or disclose it to others with your
                          specific consent. <br><br>
                          By providing your individually identifiable health
                          care information in the following Patient Registration,
                          you authorize the use of such data in our aggregate
                          patient registry, which is used to document the prevalence
                          of this condition and may be used for research purposes
                          to identify possible diagnostic or treatment options.
                          We may contact you to discuss your registration, and
                          you always have the right to either decline to discuss
                          it further or to withdraw this authorization, in which
                          case we will purge your individually identifiable information
                          from the registry. In the future, you may choose to
                          share additional individually identifiable healthcare
                          information with us, such as results of genetic tests
                          or information on your health status; we will always
                          hold such information in strictest confidence as well. <br><br>
                          We may have to disclose your information pursuant to
                          legal process, but we will always disclose only the
                          minimum necessary in such an unlikely event.<br><br>
                          Your registration will be stored in an electronic database
                          that is secured, and this authorization will end when
                          the database is destroyed.</p>
                    <p class="home">
                      <input type="checkbox" name="agree" value="1">
                      I agree and want  to register&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name="disagree" value="1">
                      I do not agree and do not want to register</p>
                    <p class="home">
                      <input type="submit" name="Submit" value="Submit">
                     
                          </p></td>
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



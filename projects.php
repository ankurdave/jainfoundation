<html>

<head>

<title>Jain Foundation Inc | Our Funded Projects</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script type="text/javascript" language="JavaScript">

<!-- Copyright 2002 Bontrager Connection, LLC

// You may use this so long as the copyright notice, above, 

//   and the "more information" statement with URL, below, 

//   are retained.

// Additional instructions and more information can be 

//   obtained from the "Instant Info" article linked from

//   http://willmaster.com/possibilities/archives/



LL_infoID = new Array();



LL_infoID[1] = "GeneEditing";

LL_infoID[2] = "StopCodonReadthrough";

LL_infoID[3] = "ExonSkipping";

LL_infoID[4] = "Chaperones";

LL_infoID[5] = "GeneTherapy";

LL_infoID[6] = "StemCellTherapy";

LL_infoID[7] = "RepairMediatingProteins";

LL_infoID[8] = "RepairMediatingDrugs";

LL_infoID[9] = "MembraneStabilization";

LL_infoID[10] = "CalciumRegulation";

LL_infoID[11] = "ApoptosisRegulation";

LL_infoID[12] = "ImmuneModulation";

LL_infoID[13] = "IncreasedRegeneration";



//

// End of customization sections.

///////////////////////////////////////////////////////////////





LL_infoID[0] = "unused";

bNS4 = bNS6 = bIE = bOPERA = false;

if     (navigator.userAgent.indexOf("Opera") != -1) { bOPERA = true; }

else if(navigator.userAgent.indexOf("Gecko") != -1) { bNS6 = true;   }

else if(document.layers)                            { bNS4 = true;   }

else if(document.all)                               { bIE = true;    }



LLx = LLxx = LLy = LLyy = 0;

var LL_mousex;

var LL_mousey;

var STO = null;

var SET = false;

var cID = '';

if(bNS4 || bNS6 || bOPERA) { document.captureEvents(Event.MOUSEMOVE); }

document.onmousemove = LL_getmouseposition;





// Functions used by all browsers



function Null() { return; }



function LL_getmouseposition(e)

{

if(bIE || bOPERA) { 

	LL_mousex = event.clientX;

	LL_mousey = event.clientY;

	}

else if(bNS6 || bNS4) {

	LL_mousex = e.pageX;

	LL_mousey = e.pageY;

	}

} // LL_getmouseposition()









// Functions to relay browser type to custom functions



function LL_showinfo(m_section) {

LL_hideallinfo();

if(cID != m_section) { SET = false; }

cID = m_section;

     if(bIE)    { LL_bIE_showit(m_section); }

else if(bNS6)   { LL_bNS6_showit(m_section); }

else if(bOPERA) { LL_bOPERA_showit(m_section); }

else if(bNS4)   { LL_bNS4_showit(m_section); }

} // LL_showinfo()



function LL_hideallinfo(m_section) {

clearTimeout(STO);

     if(bIE)    { LL_bIE_hideallinfo(); }

else if(bNS6)   { LL_bNS6_hideallinfo(); }

else if(bOPERA) { LL_bOPERA_hideallinfo(); }

else if(bNS4)   { LL_bNS4_hideallinfo(); }

} // LL_hideallinfo()









// IE functions



function LL_bIE_hidesection(m_section) {

if(LL_mouseinrectangle()) { return; }

eval(LL_infoID[m_section] + '.style.visibility="hidden"');

} // LL_bIE_hidesection()



function LL_bIE_hideallinfo() {

for(i = 1; i < LL_infoID.length; i++) { 

	eval(LL_infoID[i] + '.style.visibility="hidden"');

	}

} // LL_bIE_hideallinfo()



function LL_bIE_showit(m_section) {

	LL_bIE_hideallinfo();

	var x = LL_mousex + 1;

	if(x < 0) { x = 0; }

	var y = LL_mousey + 20;

	if(y < 0) { y = 0; }

	if(SET == false) {

		eval(LL_infoID[m_section] + '.style.left="' + x + '"');

		eval(LL_infoID[m_section] + '.style.top="' + y + '"');

		}

	eval(LL_infoID[m_section] + '.style.visibility="visible"');

	LLx = eval(LL_infoID[m_section] + '.style.pixelLeft');

	LLxx = eval(LL_infoID[m_section] + '.scrollWidth') + LLx;

	LLy = eval(LL_infoID[m_section] + '.style.pixelTop');

	LLyy = eval(LL_infoID[m_section] + '.scrollHeight') + LLy;

	SET = true;

	clearTimeout(STO);

	STO = setTimeout('SET = false',2000);

} // LL_bIE_showit()







// Netscape 6 functions



function LL_bNS6_hidesection(m_section) {

if(LL_mouseinrectangle()) { return; }

document.getElementById(LL_infoID[m_section]).style.visibility="hidden";

} // LL_bNS6_hidesection()



function LL_bNS6_hideallinfo() {

for(i = 1; i < LL_infoID.length; i++) { 

	document.getElementById(LL_infoID[i]).style.visibility="hidden";

	}

} // LL_bNS6_hideallinfo()



function LL_bNS6_showit(m_section) {

	LL_bNS6_hideallinfo();

	var x = LL_mousex + 1;

	if(x < 0) { x = 0; }

	var y = LL_mousey + 20;

	if(y < 0) { y = 0; }

	if(SET == false) {

		document.getElementById(LL_infoID[m_section]).style.left = x + 'px';

		document.getElementById(LL_infoID[m_section]).style.top = y + 'px';

		}

	document.getElementById(LL_infoID[m_section]).style.visibility="visible";

	var padding = 0;

	if(parseInt(document.getElementById(LL_infoID[m_section]).style.padding) > 0) { padding = parseInt(document.getElementById(LL_infoID[m_section]).style.padding) * 2; }

	LLx = parseInt(document.getElementById(LL_infoID[m_section]).style.left);

	LLxx = parseInt(document.getElementById(LL_infoID[m_section]).style.width) + LLx + padding;

	LLy = parseInt(document.getElementById(LL_infoID[m_section]).style.top);

	LLyy = parseInt(document.getElementById(LL_infoID[m_section]).style.height) + LLy + padding;

	SET = true;

	clearTimeout(STO);

	STO = setTimeout('SET = false',2000);

} // LL_bNS6_showit()







// Opera 6 functions

function LL_bOPERA_hidesection(m_section) {

if(LL_mouseinrectangle()) { return; }

document.getElementById(LL_infoID[m_section]).style.visibility="hidden";

} // LL_bOPERA_hidesection()



function LL_bOPERA_hideallinfo() {

for(i = 1; i < LL_infoID.length; i++) { 

	document.getElementById(LL_infoID[i]).style.visibility="hidden";

	}

} // LL_bOPERA_hideallinfo()



function LL_bOPERA_showit(m_section) {

	LL_bOPERA_hideallinfo();

	var x = LL_mousex + 1;

	if(x < 0) { x = 0; }

	var y = LL_mousey + 20;

	if(y < 0) { y = 0; }

	if(SET == false) {

		document.getElementById(LL_infoID[m_section]).style.left = x + 'px';

		document.getElementById(LL_infoID[m_section]).style.top = y + 'px';

		}

	document.getElementById(LL_infoID[m_section]).style.visibility="visible";

	var padding = 0;

	if(parseInt(document.getElementById(LL_infoID[m_section]).style.padding) > 0) { padding = parseInt(document.getElementById(LL_infoID[m_section]).style.padding) * 2; }

	LLx = parseInt(document.getElementById(LL_infoID[m_section]).style.left);

	LLxx = parseInt(document.getElementById(LL_infoID[m_section]).style.width) + LLx + padding;

	LLy = parseInt(document.getElementById(LL_infoID[m_section]).style.top);

	LLyy = parseInt(document.getElementById(LL_infoID[m_section]).style.height) + LLy + padding;

	SET = true;

	clearTimeout(STO);

	STO = setTimeout('SET = false',2000);

} // LL_bOPERA_showit()







// Netscape 4 functions



function LL_bNS4_hidesection(m_section) {

if(LL_mouseinrectangle()) { return; }

eval('document.' + LL_infoID[m_section] + '.visibility="hide"');

} // LL_bNS4_hidesection()



function LL_bNS4_hideallinfo() {

for(i = 1; i < LL_infoID.length; i++) { 

	eval('document.' + LL_infoID[i] + '.visibility="hide"');

	}

} // LL_bNS4_hideallinfo()



function LL_bNS4_showit(m_section) {

	LL_bNS4_hideallinfo();

	var x = LL_mousex + 1;

	if(x < 0) { x = 0; }

	var y = LL_mousey + 20;

	if(y < 0) { y = 0; }

	if(SET == false) {

		eval('document.' + LL_infoID[m_section] + '.left="' + x + '"');

		eval('document.' + LL_infoID[m_section] + '.top="' + y + '"');

		}

	eval('document.' + LL_infoID[m_section] + '.visibility="show"');

	LLx = eval('parseInt(document.' + LL_infoID[m_section] + '.left)');

	LLxx = eval('parseInt(document.' + LL_infoID[m_section] + '.clip.width)') + LLx;

	LLy = eval('parseInt(document.' + LL_infoID[m_section] + '.top)');

	LLyy = eval('parseInt(document.' + LL_infoID[m_section] + '.clip.height)') + LLy;

	SET = true;

	clearTimeout(STO);

	STO = setTimeout('SET = false',2000);

} // LL_bNS4_showit()



//-->

</script>

<link rel="stylesheet" href="style-old.css" type="text/css" />

<style type="text/css">

<!--

.style1 {

	font-size: 12px;

	font-weight: bold;

}

.style2 {

	font-family: Geneva, Arial, Helvetica, sans-serif;

	font-weight: bold;

	color: #CC6600;

}

.style4 {color: #0033CC}

.style5 {

	color: #FF0000;

	font-weight: bold;

}

.style7 {

	color: #FF0000;

	font-weight: bold;

}

.infoboxstyle {

    position: absolute;

	width: 400px;

	padding: 6;

	color: black;

	border: black;

	border-style: solid;

	border-top-width: 1px;

	border-bottom-width: 1px;

	border-left-width: 1px;

	border-right-width: 1px;

	background-color: #ECF1F9;

	z-index: 1;

	visibility: hidden;

	font-size: 11px;

}

.style9 {color: #EB1020; font-weight: bold; }

.style11 {font-size: 13px; font-weight: bold; color: #0175C2; }

-->

</style>

</head>



<body leftmargin="0" topmargin="10" marginwidth="0" marginheight="10">



<div

 id="GeneEditing"

 class="infoboxstyle">

Gene editing involves triggering muscle cells to edit their own DNA and change their dysferlin gene mutations back to the correct dysferlin DNA sequence. <i>This strategy is still in development.</i><br><br>We are funding one project to help develop this strategy:<br>&nbsp;&nbsp;&nbsp;&nbsp;- Thomas Rando, Stanford University

</div>

<div

 id="StopCodonReadthrough"

 class="infoboxstyle">

Stop codon readthrough involves using a small molecule to make cells ignore premature stop mutations while producing proteins, so that full-length dysferlin protein is produced instead of truncated protein. <i>This strategy is currently in clinical trials for cystic fibrosis and Duchenne muscular dystrophy.</i><br><br>

</div>

<div

 id="ExonSkipping"

 class="infoboxstyle">

Exon skipping involves giving cells instructions to skip a portion of the dysferlin coding sequence - a portion that contains a mutation - while producing the dysferlin protein, so that (almost) full-length dysferlin is produced instead of truncated protein. <i>This strategy is currently in clinical trials for Duchenne muscular dystrophy.</i><br><br>

</div>

<div

 id="Chaperones"

 class="infoboxstyle">

Chaperones are small molecules or proteins that can bind to and stabilize the normal 3-dimensional shape of proteins such as dysferlin, so that missense mutants are more likely to fold correctly instead of misfolding. <i>This strategy is currently in clinical trials for cystic fibrosis but is still in development for dysferlin deficiency.</i><br><br>We are funding one project to help develop this strategy:<br>&nbsp;&nbsp;&nbsp;&nbsp;- Simone Spuler, Charit�, University Medicine Berlin, Germany

</div>

<div

 id="GeneTherapy"

 class="infoboxstyle">

Gene therapy involves adding a new copy of the dysferlin gene (without mutations) to a patient's muscle cells, so that functional dysferlin protein can be produced from this new copy despite the mutations in the original two copies of a patient's dysferlin gene. <i>This strategy is currently in clinical trials for Duchenne muscular dystrophy.</i><br><br>We are funding two projects to apply this strategy to dysferlin deficiency:<br>&nbsp;&nbsp;&nbsp;&nbsp;- Isabelle Richard, Genethon, France<br>&nbsp;&nbsp;&nbsp;&nbsp;- Michele Calos, Stanford University

</div>

<div

 id="StemCellTherapy"

 class="infoboxstyle">

Stem cell therapy involves giving patients new muscle stem cells carrying normal copies of the dysferlin gene, so that these stem cells will give rise to new muscle fibers that can produce functional dysferlin protein. <i>This strategy will soon be in clinical trials for Duchenne muscular dystrophy.</i><br><br>We are funding one project to apply this strategy to dysferlin deficiency:<br>&nbsp;&nbsp;&nbsp;&nbsp;- Tom Rando, Stanford University

</div>

<div

 id="RepairMediatingProteins"

 class="infoboxstyle">

Repair-mediating proteins are other proteins coded by the genome that may be able to substitute for the function of dysferlin in membrane repair, and whose expression might be turned on or increased in muscle cells. <i>This strategy is still in development.</i><br><br>We are funding one project to identify repair-mediating proteins:<br>&nbsp;&nbsp;&nbsp;&nbsp;- Rumaisa Bashir, University of Durham<br>&nbsp;&nbsp;&nbsp;&nbsp;- Sandra Cooper, Childrens Hospital at Westmead (Australia)

</div>

<div

 id="RepairMediatingDrugs"

 class="infoboxstyle">

Repair-mediating drugs are small molecules that may enhance cellular membrane repair processes or may improve the membrane fusion step of cellular membrane repair even in the absense of dysferlin. <i>This strategy is still in development.</i><br><br>We are funding one project to search for repair-mediating drugs:<br>&nbsp;&nbsp;&nbsp;&nbsp;- Kevin Sonnemann, University of Wisconsin, Madison<br>

</div>

<div

 id="MembraneStabilization"

 class="infoboxstyle">

Membrane stabilization involves using small molecules and lipids to stabilize the muscle cell membrane and either help the the membrane resist tears or help it close tears on its own without requiring specific cellular repair mechanisms. <i>This strategy is still in development.</i><br><br>We are funding one project to help develop this strategy:<br>&nbsp;&nbsp;&nbsp;&nbsp;- Joshua Zimmerberg, NICHD/NIH

</div>

<div

 id="CalciumRegulation"

 class="infoboxstyle">

Calcium regulation involves interfering with cellular signalling pathways and with calcium release from compartments within a cell, so that muscle cells do not necessarily die in response to membrane damage. <i>This strategy is still in development.</i><br><br>We are funding one project to help develop this strategy:<br>&nbsp;&nbsp;&nbsp;&nbsp;- Jeffery Molkentin, University of Cincinnati

</div>

<div

 id="ApoptosisRegulation"

 class="infoboxstyle">

Apoptosis/necrosis regulation involves changing the way that muscle fibers die - from uncontrolled death to a controlled death pathway that does not cause inflammation or additional damage to other nearby cells. <i>This strategy is still in development.</i><br>

</div>

<div

 id="ImmuneModulation"

 class="infoboxstyle">

Immune modulation involves using drugs to suppress inflammation so that a patient's immune response to degenerating muscle does not cause additional death of muscle cells. <i>This strategy is used to partially manage other muscular dystrophies but is still in development for dysferlin deficiency.</i>

</div>

<div

 id="IncreasedRegeneration"

 class="infoboxstyle">

Increased regeneration involves stimulating a patient's existing muscle stem cells to form new muscle fibers at a faster rate, in order to replace the fibers that are dying. <i>One method of implementing this strategy is currently in clinical trials for a range of muscular dystrophies.</i><br><br>We are funding two projects to develop additional implementations of this strategy:<br>&nbsp;&nbsp;&nbsp;&nbsp;- Robert Bloch, University of Maryland<br>&nbsp;&nbsp;&nbsp;&nbsp;- Se-Jin Lee, Johns Hopkins University School of Medicine.

</div>





<table width="102%" height="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="center">

	

	<table width="780" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="4" background="images/bg_green.gif"></td>

      </tr>

    </table>

	

	<table width="780" height="36" border="0" cellspacing="0" cellpadding="0">

      <tr><? include 'includes/topbar.php'; ?>

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

                  <td><img src="images/button_ourFunded_roll.gif" width="168" height="32" border="0"></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7">&nbsp;&nbsp;&nbsp;<span class="style2">Research Projects</span></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7"><? include 'includes/projects.php'; ?></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7" height="6"></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7">&nbsp;&nbsp;&nbsp;<span class="style2">Past Research Projects</span></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7"><? include 'includes/projects_past.php'; ?></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7" height="6"></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7">&nbsp;&nbsp;&nbsp;<span class="style2">Diagnostic Projects</span></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7"><? include 'includes/projects_diag.php'; ?></td>

                </tr>

				<tr>

                  <td bgcolor="#FEFFD7" height="6"></td>

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

                  <td><a href="patients.php" onMouseOver="window.document.sq7.src='images/button_patient_roll.gif'" 

onMouseOut="window.document.sq7.src='images/button_patient.gif'"><img src="images/button_patient.gif" border="0" name="sq7" alt="Patient Registration" width="168" height="32"></a></td>

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

                <table width="168" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td><img src="images/header_researchers.gif" width="168" height="26"></td>

                  </tr>

                  <tr>

                    <td background="images/box_bgMain-old.gif" valign="top"><p class="left">

                        <? include 'includes/resources.php'; ?>

                        <br>

                    </td>

                  </tr>

                  <tr>

                    <td><img src="images/box_bottom.gif" width="168" height="10"></td>

                  </tr>

                </table>

            </td>

            <td valign="top" align="center"><table width="92%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td valign="top" height="13"></td>

              </tr>

              <tr>

                <td valign="top"><p class="section">Research Projects</p>

                    <p align="right" class="home"><a href="projects_alph.php" class="style4">Alphabetical listing</a><br>

                    of projects by PI name<br>

                    <br>

                      <a href="publications.php" class="style4">View research publications</a><br>

                      funded in part by the Jain Foundation</p>

                    <p class="home"><span class="style11">Project Descriptions</span><br>

                      <br>

                        <strong><span class="style1">&lt;--- </span>Click on the therapeutic strategies at left </strong>or <strong>in the diagram below</strong> to view brief descriptions

                      of our funded research projects for each therapeutic strategy. The number of projects in each category is indicated at left.<br>

                      <br><br>

                      <span class="style11">Therapeutic Strategies Diagram</span>                      <br>

                      <br>

                      The diagram below illustrates the different

                      therapeutic strategies that we have identified towards

                      a cure for LGMD2B/Miyoshi, and how each strategy blocks the progression of disease. <strong>Hover your mouse </strong>over the strategies in the diagram for explanations. <strong><br>

                      </strong><strong><br>

                      <br>

                      Black = Disease pathway </strong> <br>

                      <span class="style5 style7"><span class="style9">Red</span></span><span class="style9"> = Therapeutic strategy</span> <br>

                      <br><br><br>

                      &nbsp; &nbsp;

                      <img src="images/therapies.gif" border="0" align="middle" usemap="#therapies" ><br>

                    </p></td>

              </tr>

            </table>

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



<map name="therapies">

<area shape="rect" coords="231,0,281,34" href="project9.php#3" onMouseOver="LL_showinfo(1)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="20,38,106,70" onMouseOver="LL_showinfo(2)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="7,80,107,98" href="projects.php" onMouseOver="LL_showinfo(3)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="210,88,294,105" href="project16.php" onMouseOver="LL_showinfo(4)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="25,225,118,243" href="project6.php" onMouseOver="LL_showinfo(5)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="0,252,119,270" href="project12.php" onMouseOver="LL_showinfo(6)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="285,285,398,317" href="project4.php" onMouseOver="LL_showinfo(7)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="286,326,399,360" href="projects.php" onMouseOver="LL_showinfo(8)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="46,328,130,362" href="project2.php" onMouseOver="LL_showinfo(9)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="91,429,221,447" href="project11.php" onMouseOver="LL_showinfo(10)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="-3,470,129,504" onMouseOver="LL_showinfo(11)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="14,528,94,560" onMouseOver="LL_showinfo(12)" onMouseOut="LL_hideallinfo()">

<area shape="rect" coords="309,496,397,530" href="project8.php" onMouseOver="LL_showinfo(13)" onMouseOut="LL_hideallinfo()">

</map></body>

</html>
<?php
	include_once 'lib.php';

	// Prints the standard page header. Handles escaping for you.
	// $args_raw should be an assoc array.
	function printHeader($args_raw = array()) {
		$args = array_map('print_html', $args_raw);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<!--[if IE]>
		<link rel="stylesheet" href="style-ie.css" type="text/css" />
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" href="style-ie6.css" type="text/css" />
	<![endif]-->
	<style type="text/css">
	<?php if (isset($args['page_nav_id'])) { ?>
		li#<?php echo $args['page_nav_id'] ?> a {
			background-color: white;
		}
	<?php } ?>
	</style>
	<?php
		if (is_array($args['scripts'])) {
			foreach ($args['scripts'] as $script) {
	?>
				<script type="text/javascript" src="<?php echo $script ?>"></script>
	<?php
			}
		}
	?>

	<title>Jain Foundation Inc | <?php echo $args['title'] ?></title>
</head>

<body>
<div id="page_wrapper">

<div id="header">
	<div id="top_nav_wrapper">
		<ul id="top_nav">
			<li id="button_home" style="background: url(images/button_home2_roll.gif) no-repeat">
				<a href="index.php">
					<img src="images/button_home2.gif" alt="Home" />
				</a>
			</li>
			<li id="button_about" style="background: url(images/button_about_roll.gif) no-repeat">
				<a href="about.php">
					<img src="images/button_about.gif" alt="About Us" />
				</a>
			</li>
			<li id="button_contact" style="background: url(images/button_contact2_roll.gif) no-repeat">
				<a href="contact.php">
					<img src="images/button_contact2.gif" alt="Contact Us" />
				</a>
			</li>
		</ul>
	</div>
	<div id="logo" style="clear:both">
		<img src="images/logo_jain.gif" alt="Jain Foundation" /><img src="images/logo_jain2.gif" alt="Orchestrating a cure for LGMD2B/Miyoshi - Speed. Focus. Discover." />
	</div>
</div>

<div id="body">

<div id="sidebar">
	<ul id="side_nav">
		<li id="button_projects" style="background: url(images/button_ourFunded_roll.gif) no-repeat">
			<a href="projects.php">
				<img src="images/button_ourFunded.gif" alt="Our Funded Projects" />
			</a>
		</li>
		<li id="button_conferences" style="background: url(images/button_conferences_roll.gif) no-repeat">
			<a href="conferences.php">
				<img src="images/button_conferences.gif" alt="Sponsored Conferences" />
			</a>
		</li>
		<li id="button_apply" style="background: url(images/button_apply_roll.gif) no-repeat">
			<a href="apply.php">
				<img src="images/button_apply.gif" alt="Apply for Funding" />
			</a>
		</li>
		<li id="button_papers" style="background: url(images/button_papers_roll.gif) no-repeat">
			<a href="papers.php">
				<img src="images/button_papers.gif" alt="Relevant Scientific Papers" />
			</a>
		</li>
		<li id="button_patients" style="background: url(images/button_patient_roll.gif) no-repeat">
			<a href="patients.php">
				<img src="images/button_patient.gif" alt="Patient Registration" />
			</a>
		</li>
		<li id="button_faq" style="background: url(images/button_faq_roll.gif) no-repeat">
			<a href="faq.php">
				<img src="images/button_faq.gif" alt="FAQ on LGMD2B/Miyoshi" />
			</a>
		</li>
		<li id="button_links" style="background: url(images/button_links2_roll.gif) no-repeat">
			<a href="links.php">
				<img src="images/button_links2.gif" alt="Helpful Links" />
			</a>
		</li>
	</ul>
	
	<div id="search">
	<? include 'search.inc.php'; ?>
	</div>
	
	<div id="resources_for_researchers">
		<img src="images/header_researchers.gif" alt="Resources for Researchers" />
		<div id="resources_list">
			<ul>
				<li class="emph"><a href="http://sharing.jain-foundation.org">Resource Sharing Network</a></li>
				<li class="emph"><a href="/forum/">Scientific Forum</a></li>
				<li class="emph"><a href="database/database_search.php">The A to Z of Dysferlin Answers to Questions</a></li>
				<li class="emph"><a href="cdna.php">Dysferlin cDNA Clones Mouse and Human -Free!-</a></li>
				<li><a href="downloads/human_protein.pdf">Human DYSF protein sequence and domains</a></li>
				<li><a href="downloads/protein_alignment.pdf">Mouse-human DYSF protein sequence alignment</a></li>
				<li><a href="downloads/mouse_models.pdf">Mouse models of dysferlin deficiency</a></li>
				<li><a href="downloads/antibodies.pdf">Anti-DYSF antibodies</a></li>
				<li><a href="downloads/ferlin_domains.pdf">Ferlin family members: conserved domains</a></li>
				<li><a href="downloads/ferlin_homology.pdf">Ferlin family members: homology scores</a></li>
				<li><a href="downloads/splice_variants.pdf">Dysferlin splice variants</a></li>
				<li><a href="downloads/sequences.pdf">Comparison of dysferlin sequences from GenBank</a></li>
				<li><a href="downloads/population_mutations.pdf">Population-specific and founder mutations</a></li>
			</ul>
		</div>
	</div>
</div>

<div id="content">

<?php
	}

	// Prints the standard page footer. Handles escaping for you.
	// $args_raw should be an assoc array.
	function printFooter($args_raw = array()) {
		$args = array_map('print_html', $args_raw);
?>

</div>
</div>

<div id="footer">
	<a href="legal.php">View legal disclaimer</a><br />
	&copy; 2006 Jain Foundation Inc. All Rights Reserved
</div>

</div>
</body>
</html>
<?php
	}
?>

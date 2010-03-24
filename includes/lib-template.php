<?php
	// Prints the standard page header. Handles escaping for you.
	// $args_raw should be an assoc array.
	function printHeader($args_raw = array()) {
		global $Config;
		
		$args = array_map('print_html', $args_raw);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<script type="text/javascript" src="<?php echo $Config['URLPath'] ?>/js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#sidebar a").attr("target", "_blank");
		});
	</script>
	
	<link rel="stylesheet" href="<?php echo $Config['URLPath'] ?>/style.css" type="text/css" />
	<!--[if IE]>
		<link rel="stylesheet" href="<?php echo $Config['URLPath'] ?>/style-ie.css" type="text/css" />
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" href="<?php echo $Config['URLPath'] ?>/style-ie6.css" type="text/css" />
	<![endif]-->
	
	<?php
		if (is_array($args['scripts'])) {
			foreach ($args['scripts'] as $script) {
	?>
				<script type="text/javascript" src="<?php echo $script ?>"></script>
	<?php
			}
		}
	?>

	<style type="text/css">
	<?php if (isset($args['page_nav_id'])) { ?>
		li#<?php echo $args['page_nav_id'] ?> a {
			background-color: white;
		}
	<?php } ?>
	</style>
	
	<title>Jain Foundation Inc | <?php echo $args['title'] ?></title>
</head>

<body>
<div id="page_wrapper">

<div id="header">
	<div id="top_nav_wrapper">
		<ul id="top_nav">
			<li id="button_home" style="background: url(<?php echo $Config['URLPath'] ?>/images/button_home2_roll.gif) no-repeat">
				<a href="<?php echo $Config['URLPath'] ?>/index.php">
					<img src="<?php echo $Config['URLPath'] ?>/images/button_home2.gif" alt="Home" />
				</a>
			</li>
			<li id="button_about" style="background: url(<?php echo $Config['URLPath'] ?>/images/button_about_roll.gif) no-repeat">
				<a href="<?php echo $Config['URLPath'] ?>/about.php">
					<img src="<?php echo $Config['URLPath'] ?>/images/button_about.gif" alt="About Us" />
				</a>
			</li>
			<li id="button_contact" style="background: url(<?php echo $Config['URLPath'] ?>/images/button_contact2_roll.gif) no-repeat">
				<a href="<?php echo $Config['URLPath'] ?>/contact.php">
					<img src="<?php echo $Config['URLPath'] ?>/images/button_contact2.gif" alt="Contact Us" />
				</a>
			</li>
		</ul>
	</div>
	<div id="logo" style="clear:both">
		<img src="<?php echo $Config['URLPath'] ?>/images/logo_jain.gif" alt="Jain Foundation" /><img src="<?php echo $Config['URLPath'] ?>/images/logo_jain2.gif" alt="Orchestrating a cure for LGMD2B/Miyoshi - Speed. Focus. Discover." />
	</div>
</div>

<div id="body">

<div id="sidebar">
	<ul id="side_nav">
		<li id="button_projects" style="background: url(<?php echo $Config['URLPath'] ?>/images/button_ourFunded_roll.gif) no-repeat">
			<a href="<?php echo $Config['URLPath'] ?>/projects.php">
				<img src="<?php echo $Config['URLPath'] ?>/images/button_ourFunded.gif" alt="Our Funded Projects" />
			</a>
		</li>
		<li id="button_conferences" style="background: url(<?php echo $Config['URLPath'] ?>/images/button_conferences_roll.gif) no-repeat">
			<a href="<?php echo $Config['URLPath'] ?>/conferences.php">
				<img src="<?php echo $Config['URLPath'] ?>/images/button_conferences.gif" alt="Sponsored Conferences" />
			</a>
		</li>
		<li id="button_apply" style="background: url(<?php echo $Config['URLPath'] ?>/images/button_apply_roll.gif) no-repeat">
			<a href="<?php echo $Config['URLPath'] ?>/apply.php">
				<img src="<?php echo $Config['URLPath'] ?>/images/button_apply.gif" alt="Apply for Funding" />
			</a>
		</li>
		<li id="button_papers" style="background: url(<?php echo $Config['URLPath'] ?>/images/button_papers_roll.gif) no-repeat">
			<a href="<?php echo $Config['URLPath'] ?>/papers.php">
				<img src="<?php echo $Config['URLPath'] ?>/images/button_papers.gif" alt="Relevant Scientific Papers" />
			</a>
		</li>
		<li id="button_patients" style="background: url(<?php echo $Config['URLPath'] ?>/images/button_patient_roll.gif) no-repeat">
			<a href="<?php echo $Config['URLPath'] ?>/patients.php">
				<img src="<?php echo $Config['URLPath'] ?>/images/button_patient.gif" alt="Patient Registration" />
			</a>
		</li>
		<li id="button_faq" style="background: url(<?php echo $Config['URLPath'] ?>/images/button_faq_roll.gif) no-repeat">
			<a href="<?php echo $Config['URLPath'] ?>/faq.php">
				<img src="<?php echo $Config['URLPath'] ?>/images/button_faq.gif" alt="FAQ on LGMD2B/Miyoshi" />
			</a>
		</li>
		<li id="button_links" style="background: url(<?php echo $Config['URLPath'] ?>/images/button_links2_roll.gif) no-repeat">
			<a href="<?php echo $Config['URLPath'] ?>/links.php">
				<img src="<?php echo $Config['URLPath'] ?>/images/button_links2.gif" alt="Helpful Links" />
			</a>
		</li>
	</ul>
	
	<div id="search">
	<? include 'search.inc.php'; ?>
	</div>
	
	<div id="resources_for_researchers">
		<img src="<?php echo $Config['URLPath'] ?>/images/header_researchers.gif" alt="Resources for Researchers" />
		<div id="resources_list">
			<ul>
				<li class="emph"><a href="http://sharing.jain-foundation.org">Resource Sharing Network</a></li>
				<li class="emph"><a href="<?php echo $Config['URLPath'] ?>/forum/">Scientific Forum</a></li>
				<li class="emph"><a href="<?php echo $Config['URLPath'] ?>/database/database_search.php">The A to Z of Dysferlin Answers to Questions</a></li>
				<li class="emph"><a href="<?php echo $Config['URLPath'] ?>/cdna.php">Dysferlin cDNA Clones Mouse and Human -Free!-</a></li>
				<li><a href="<?php echo $Config['URLPath'] ?>/downloads/human_protein.pdf">Human DYSF protein sequence and domains</a></li>
				<li><a href="<?php echo $Config['URLPath'] ?>/downloads/protein_alignment.pdf">Mouse-human DYSF protein sequence alignment</a></li>
				<li><a href="<?php echo $Config['URLPath'] ?>/downloads/mouse_models.pdf">Mouse models of dysferlin deficiency</a></li>
				<li><a href="<?php echo $Config['URLPath'] ?>/downloads/antibodies.pdf">Anti-DYSF antibodies</a></li>
				<li><a href="<?php echo $Config['URLPath'] ?>/downloads/ferlin_domains.pdf">Ferlin family members: conserved domains</a></li>
				<li><a href="<?php echo $Config['URLPath'] ?>/downloads/ferlin_homology.pdf">Ferlin family members: homology scores</a></li>
				<li><a href="<?php echo $Config['URLPath'] ?>/downloads/splice_variants.pdf">Dysferlin splice variants</a></li>
				<li><a href="<?php echo $Config['URLPath'] ?>/downloads/sequences.pdf">Comparison of dysferlin sequences from GenBank</a></li>
				<li><a href="<?php echo $Config['URLPath'] ?>/downloads/population_mutations.pdf">Population-specific and founder mutations</a></li>
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
		global $Config;
		
		$args = array_map('print_html', $args_raw);
?>

</div>
</div>

<div id="footer">
	<a href="<?php echo $Config['URLPath'] ?>/legal.php">View legal disclaimer</a><br />
	&copy; 2006 Jain Foundation Inc. All Rights Reserved
</div>

</div>
</body>
</html>
<?php
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo settings('site_title'); ?></title>

<!-- Meta -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<!--Stylesheets-->
    		<?php
      			elementaire_queue_css('reset.css');
      			elementaire_queue_css('screen.css');
			display_css();
    		?>

<!-- JavaScripts -->
<?php echo js('prototype'); ?>

<!-- Plugin Stuff -->
<?php plugin_header(); ?>

<!-- Load Google Font Stylesheet for Header--> 
<?php 
	if (get_theme_option('Heading Text Font') != NULL) {
		$headingTextFont=get_theme_option('Heading Text Font');  
		$googleLink="<link href='http://fonts.googleapis.com/css?family=".$headingTextFont."' rel='stylesheet' type='text/css'>";
		echo $googleLink;
	} 
?>

<!-- Load Google Font Stylesheet for Body--> 
<?php 
	if (get_theme_option('Body Text Font') != NULL) {
		$bodyTextFont=get_theme_option('Body Text Font');  
		$googleLink="<link href='http://fonts.googleapis.com/css?family=".$bodyTextFont."' rel='stylesheet' type='text/css'>";
		echo $googleLink;
	} 
?>

<!-- Custom Styles --> 
<style type="text/css"> 
	body { 
		background-color: <?php echo get_theme_option('Background Color'); ?>;
		background-image: url('<?php echo elementaire_custom_background(); ?>');
	} 
	#wrap { 
		background-color: <?php echo get_theme_option('Inner Background Color'); ?>;
	} 
	#header { 
		background-image: url('<?php echo elementaire_custom_header_background(); ?>');
	}
	h1 a, h1 a:visited { 
		color: <?php echo get_theme_option('Heading Color'); ?>;
		font-family: <?php echo get_theme_option('Heading Text Font'); ?>;
	}
	p { 
		color: <?php echo get_theme_option('Body Text Color'); ?>;
		font-family: <?php echo get_theme_option('Body Text Font'); ?>;
	} 	
	

</style>

</head>
<body<?php echo $bodyclass ? ' class="'.$bodyclass.'"' : ''; ?>  id="<?php echo html_escape($exhibit->theme); ?>">

<div id="wrap">
	<div id="header">
		<h5><a href="<?php echo html_escape(uri('exhibits')); ?>">Back to Exhibits</a></h5>
		<div id="logo"><?php echo link_to_home_page(custom_display_logo()); ?></div>
		<h1><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h1>
	</div> <!-- end of Header --> 

    <div id="exhibit-nav">
    	<?php echo exhibit_builder_section_nav();?>
    </div>

    <div id="content">
    	<?php echo exhibit_builder_page_nav(); ?>
    <?php echo flash(); ?>				


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo get_html_lang(); ?>" class="<?php echo (get_theme_option('Style Sheet') ? get_theme_option('Style Sheet') : 'vertical'); ?>"> 
<head>
<title><?php echo settings('site_title'); ?></title>
<!-- Meta -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--Stylesheets-->
    		<?php
      			elementaire_queue_css('style.css');
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
		background-color: <?php echo get_theme_option('Page Background Color'); ?>;
	} 
	#content { 
		<?php if (get_theme_option('Hide Dividers')) echo 'border-left: none;'; ?>
        }
	#header { 
		background-image: url('<?php echo elementaire_custom_header_background(); ?>');
	}
	h1, h2, h3, h4, h5, h1 a, h1 a:visited { 
		color: <?php echo get_theme_option('Heading Color'); ?>;
		font-family: <?php echo get_theme_option('Heading Text Font'); ?>;			
	}
	p { 
		color: <?php echo get_theme_option('Body Text Color'); ?>;
		font-family: <?php echo get_theme_option('Body Text Font'); ?>;
	} 	
	#exhibit-sections { 
		<?php if ((int)get_theme_option('Display Exhibit Sections')==0) echo 'display: none;' ?> 
	}
	.exhibit-section-nav li a, .exhibit-page-nav li a { 
		color: <?php echo get_theme_option('Link Color'); ?>;
	}
	.exhibit-section-nav li.current a, .exhibit-section-nav li a:hover, .exhibit-page-nav li.current a, .exhibit-page-nav li a:hover { 
		color: <?php echo get_theme_option('Active Link Color'); ?> !important;
		background-color: <?php echo get_theme_option('Active Link Background Color') ; ?> !important;
	}
	
</style>
</head>
<body<?php echo $bodyclass ? ' class="'.$bodyclass.'"' : ''; ?>  id="<?php echo html_escape($exhibit->theme); ?>">
<div id="wrap">
	<div id="header">
		<h5><a href="<?php echo html_escape(uri('exhibits')); ?>">Back to Exhibits</a></h5>
		<div id="logo"><?php echo link_to_home_page(custom_display_logo()); ?></div>
		<?php if ((int)get_theme_option('Hide Header Text')==1) { 
			$exhibitHeaderTextHTML= '<h1>&nbsp;&nbsp;</h1>'; // this is a placeholder so that the background image doesn't get cut off 
			echo $exhibitHeaderTextHTML;
		} else { 
			$exhibitHeaderTextHTML= '<h1>'.exhibit_builder_link_to_exhibit($exhibit).'</h1>'; 
			echo $exhibitHeaderTextHTML;
		}
		?> 
	</div> <!-- end of Header --> 
    <div id="exhibit-nav">
    	<?php echo exhibit_builder_section_nav();?>
    	<?php echo exhibit_builder_page_nav(); ?>
    </div>
    <div id="content">
    <?php echo flash(); ?>				

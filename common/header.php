<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>" class="<?php echo (get_theme_option('Style Sheet') ? get_theme_option('Style Sheet') : 'vertical'); ?>"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_url('http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
    queue_css_file('normalize');
    queue_css_file('style');
    echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php queue_js_file('vendor/modernizr'); ?>
    <?php queue_js_file('vendor/selectivizr'); ?>
    <?php queue_js_file('jquery-extra-selectors'); ?>
    <?php queue_js_file('vendor/respond'); ?>
    <?php queue_js_file('globals'); ?>
    <?php echo head_js(); ?>

<!-- Load Google Font Stylesheet for Header--> 
<?php 
	if (get_theme_option('Heading Text Font') != NULL) {
		$headingTextFont=get_theme_option('Heading Text Font');  
		$googleLink="<link href='http://fonts.googleapis.com/css?family=".$headingTextFont."' rel='stylesheet' type='text/css'>";
		echo $googleLink;
	} 
    
        // Load Google Font Stylesheet for Body--> 
	if (get_theme_option('Body Text Font') != NULL) {
		$bodyTextFont=get_theme_option('Body Text Font');  
		$googleLink="<link href='http://fonts.googleapis.com/css?family=".$bodyTextFont."' rel='stylesheet' type='text/css'>";
		echo $googleLink;
	} 
	
	// Load Google Font Stylesheet for Nav
	if (get_theme_option('Navigation Font') != NULL) {
		$navigationFont=get_theme_option('Navigation Font');  
		$googleLink="<link href='http://fonts.googleapis.com/css?family=".$navigationFont."' rel='stylesheet' type='text/css'>";
		echo $googleLink;
	} 
	
	// Get Variables for Navigation Colors to be Used in Custom Styles Below
	if (get_theme_option('Navigation Color One') != NULL) {
		$navColorOne=get_theme_option('Navigation Color One');
	} 
	if (get_theme_option('Navigation Color Two') != NULL) {
		$navColorTwo=get_theme_option('Navigation Color Two');
	} 
?>
    	
<!-- Custom Styles --> 
<style type="text/css"> 
	body.exhibits { 
		background-color: <?php echo get_theme_option('Background Color'); ?>;
		background-image: url('<?php echo elementaire_custom_background(); ?>');
	} 
	.exhibits #wrap { 
		background-color: <?php echo get_theme_option('Page Background Color'); ?>;
	}
	.exhibits #content { 
		<?php if (get_theme_option('Hide Dividers')) echo 'border-left: none;'; ?>
        }
	.exhibits #header { 
		<?php if (get_theme_option('Header Background')): ?> 
			background-image: url('<?php echo elementaire_custom_header_background(); ?>');
			height: 120px; 
			width: 950px; 
			display: table; 
		<?php endif; ?> 
	}
	.exhibits #header h1 { 
		<?php if (get_theme_option('Header Background')): ?> 
			display: table-cell; 
		<?php endif; ?> 
		<?php if (get_theme_option('Hide Header Text')): ?> 
			display: none; 
		<?php endif; ?> 
	} 
	.exhibits #exhibit-pages, .exhibits #exhibit-page-navigation a, .exhibits #exhibit-page-navigation .current-page { 
		font-family: <?php echo get_theme_option('Navigation Font'); ?>;
        }
	.horizontal .exhibit-page-title, .vertical .exhibit-page-title, #exhibit-nav-up a, #exhibit-nav-prev a, #exhibit-nav-next a { 
		background-color: <?php echo get_theme_option('Navigation Color One'); ?>;
		color: <?php echo get_theme_option('Navigation Color Two'); ?>;
	}
	.horizontal .current .exhibit-page-title, .horizontal .exhibit-page-title:hover,  .vertical .current .exhibit-page-title, .vertical .exhibit-page-title:hover, .exhibits #exhibit-nav-up .current-page, #exhibit-nav-up a:hover, #exhibit-nav-next a:hover, #exhibit-nav-prev a:hover { 
		background-color: <?php echo get_theme_option('Navigation Color Two'); ?>;
		color: <?php echo get_theme_option('Navigation Color One'); ?>;
	}  
	.horizontal .exhibit-page-title, .vertical .exhibit-page-title { 
		background-color: <?php echo get_theme_option('Navigation Color One'); ?>;
		color: <?php echo get_theme_option('Navigation Color Two'); ?>;
	}	
	.exhibits.summary #exhibit-pages li a:hover { 
		background-color: <?php echo get_theme_option('Navigation Color Two'); ?>;
		color: <?php echo get_theme_option('Navigation Color One'); ?>;
	}  
	.vertical .exhibit-page-title, .exhibits.summary #exhibit-pages li a { 
		background-color: <?php echo get_theme_option('Navigation Color One'); ?>; 
		color: <?php echo get_theme_option('Navigation Color Two'); ?>;
	} 
	#content p a { 
		color: <?php echo get_theme_option('Navigation Color Two'); ?>;
	} 
	.exhibits.summary #exhibit-pages a { 
		border-left-color: <?php echo get_theme_option('Navigation Color Two'); ?>; 
	}
	.exhibits.show h1, .exhibits.show h2, .exhibits.show h3, .exhibits.show h4, .exhibits.show h5, .exhibits.show h1 a, .exhibits.show h1 a:visited, .exhibits.summary #content h1 { 
		color: <?php echo get_theme_option('Heading Color'); ?>;
		font-family: <?php echo get_theme_option('Heading Text Font'); ?>;			
	}
	.exhibits.show #content h1, .exhibits.summary #content h1 { 
		font-size: <?php echo get_theme_option('Heading Font Size'); ?>; 
		color: <?php echo get_theme_option('Heading Color'); ?>;
		font-family: <?php echo get_theme_option('Heading Text Font'); ?>;			
	} 
	p, .exhibits.show .exhibit-text p { 
		color: <?php echo get_theme_option('Body Text Color'); ?>;
		font-family: <?php echo get_theme_option('Body Text Font'); ?>;
		font-size: <?php echo get_theme_option('Body Font Size'); ?>; 
	} 	
	#exhibit-sections { 
		<?php if ((int)get_theme_option('Display Exhibit Sections')==0) echo 'display: none;' ?> 
	}
/*	.exhibits #exhibit-pages a { 
		color: <?php echo get_theme_option('Navigation Color Two'); ?>; 
	} */ 
/*	.exhibits #exhibit-page-navigation a { 
		color: <?php echo get_theme_option('Navigation Color Two'); ?>;
	} */ 
		
	</style>

</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
        <header>
            <div id="site-title">
                <?php echo link_to_home_page(); ?>
            </div>
            <div id="search-container">
                <?php echo search_form(array('show_advanced' => true)); ?>
            </div>
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        </header>

    <div id="wrap">
        <nav class="top">
            <?php echo public_nav_main(); ?>
        </nav>

        <div id="content">
		<?php if (theme_logo()): ?> 
		<div id="logo"> 
			<?php echo theme_logo(); ?> 
		</div> <!--end logo--> 
		<?php endif; ?> 

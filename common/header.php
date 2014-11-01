<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
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
    queue_css_url('//fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
    queue_css_file(array('iconfonts', 'normalize', 'style'), 'screen');
    queue_css_file('print', 'print');
    echo head_css();
    ?>

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
	header a, h1, h2, h3, h4, h5, h6 { 
		<?php if (get_theme_option('Heading Text Font')) echo 'font-family: ' .  get_theme_option('Heading Text Font'); ?>			
	}
	nav li a, .exhibits #exhibit-pages, .exhibits #exhibit-page-navigation a, .exhibits #exhibit-page-navigation .current-page { 
		<?php if (get_theme_option('Navigation Font')) echo 'font-family: ' .  get_theme_option('Navigation Font'); ?>
	} 
	body { 
		font-family: <?php echo get_theme_option('Body Text Font'); ?>;
	} 

 /* colors */ 
  #wrap body, #wrap footer, #wrap .exhibit-page-nav, #wrap nav.top {
    <?php if (get_theme_option('Color One')) echo 'background-color: ' . get_theme_option('Color One'); ?> 
  }
  #wrap h1, #wrap #site-title a {
    <?php if (get_theme_option('Color Three')) echo 'color: ' . get_theme_option('Color Three'); ?> 
  }
  #wrap a:visited {
    <?php if (get_theme_option('Color Five')) echo 'color: ' . get_theme_option('Color Five'); ?> 
  }
  #wrap a:hover, #wrap a:active {
    <?php if (get_theme_option('Color Four')) echo 'color: ' . get_theme_option('Color Four'); ?> 
  }
  #wrap #content,
  #wrap #secondary-nav .current a,
  #wrap #secondary-nav a.current,
  #wrap .secondary-nav .current a,
  #wrap .secondary-nav a.current,
  #wrap .exhibit-section-nav .current a {
    <?php if (get_theme_option('Color Five')) echo 'background-color: ' . get_theme_option('Color Five'); ?> 
  }
  #wrap #content div {
    <?php if (get_theme_option('Color Three')) echo 'border-color: ' . get_theme_option('Color Three'); ?> 
  }
  #wrap #content .pagination_previous a, #wrap #content .pagination_next a, #wrap #content nav .pagination_list, #wrap a:link, #wrap nav.top, #wrap nav.top ul li ul {
    <?php if (get_theme_option('Color Two')) echo 'color: ' . get_theme_option('Color Two'); ?> 
  }

</style> 

    <!-- JavaScripts -->
    <?php queue_js_file('vendor/modernizr'); ?>
    <?php queue_js_file('vendor/selectivizr'); ?>
    <?php queue_js_file('jquery-extra-selectors'); ?>
    <?php queue_js_file('vendor/respond'); ?>
    <?php queue_js_file('globals'); ?>
    <?php echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <div id="wrap">
        <header>
            <div id="site-title">
                <?php echo link_to_home_page(theme_logo()); ?>
            </div>
            <div id="search-container">
                <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
                <?php echo search_form(array('show_advanced' => true)); ?>
                <?php else: ?>
                <?Php echo search_form(); ?>
                <?php endif; ?>
            </div>
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        </header>

        <nav class="top">
            <?php echo public_nav_main(); ?>
        </nav>

        <div id="content">
            <?php
                if(! is_current_url(WEB_ROOT)) {
                  fire_plugin_hook('public_content_top', array('view'=>$this));
                }
            ?>

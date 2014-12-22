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

<?php 
   	require_once( 'colors.php' );  
    
        // Load Google Font Stylesheet for Header
	if (get_theme_option('Heading Text Font') != NULL) {
		$headingTextFont=get_theme_option('Heading Text Font');  
		$googleLink="<link href='http://fonts.googleapis.com/css?family=".$headingTextFont."' rel='stylesheet' type='text/css'>";
		echo $googleLink;
	} 
    
        // Load Google Font Stylesheet for Body
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
	// @todo Deprecate this. 
	if (get_theme_option('Navigation Color One') != NULL) {
		$navColorOne=get_theme_option('Navigation Color One');
	} 
	if (get_theme_option('Navigation Color Two') != NULL) {
		$navColorTwo=get_theme_option('Navigation Color Two');
	} 

	// Get color preferences from config. 
	if (get_theme_option('Color One') != NULL) { 
		$c1 = get_theme_option('Color One'); 
		$v = ( is_light_color( hex_to_rgb( $c1 ) ) ) ?  -1 : 1; 
		$c1v2 = colorBrightness( $c1, $v * 0.2 );  
		$c1v3 = colorBrightness( $c1, $v * 0.3 );  
		$c1v4 = colorBrightness( $c1, $v * 0.4 );  
		$c1v5 = colorBrightness( $c1, $v * 0.5 );  
		$c1v6 = colorBrightness( $c1, $v * 0.6 );  
		$c1v7 = colorBrightness( $c1, $v * 0.7 );  
		$c1v2i = colorBrightness( $c1, $v * -0.7 );  
	} 
	if (get_theme_option('Color Two') != NULL) { 
		$c2 = get_theme_option('Color Two'); 
		$v = ( is_light_color( hex_to_rgb ( $c2 ) ) ) ?  -1 : 1; 
		$c2v2 = colorBrightness( $c2, $v * 0.2 );  
		$c2v3 = colorBrightness( $c2, $v * 0.3 );  
		$c2v4 = colorBrightness( $c2, $v * 0.4 );  
		$c2v5 = colorBrightness( $c2, $v * 0.5 );  
		$c2v6 = colorBrightness( $c2, $v * 0.6 );  
		$c2v7 = colorBrightness( $c2, $v * 0.7 );  
		$c2v2i = colorBrightness( $c2, $v * -0.7 );  
	} 
	if (get_theme_option('Color Three') != NULL) { 
		// Body text color 
		$c3 = get_theme_option('Color Three'); 
	} 
	if (get_theme_option('Color Four') != NULL) { 
		// Link color and other highlights
		$c4 = get_theme_option('Color Four'); 
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

	<?php require_once( 'custom-sass.php' ); ?>  
	<?php require_once( 'custom-sass.php' ); ?>  

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

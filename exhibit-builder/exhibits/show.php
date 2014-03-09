<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show'));
?>
<nav id="exhibit-pages">
    <?php echo elementaire_exhibit_builder_page_nav(); ?>
</nav>

<h1><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></span></h1>

<!-- <nav id="exhibit-child-pages">
    <?php // echo exhibit_builder_child_page_nav(); ?>
</nav> --> 

<div role="main">
<?php 
if (elementaire_exhibit_page_is_empty()) {
//	echo "Exhibit page is empty"; 
//	echo "Exhibit page used to be: "; 
//	print_r($exhibit); 
//	print_r($exhibitPage); 
	
	if (!isset($exhibitPage)) {
		if (!($exhibitPage = get_current_record('exhibit_page', false))) {
			return;
		}
	}

	$exhibitPage = elementaire_get_first_nonempty_page($exhibit, $exhibitPage); 
//	echo "Exhibit page now is: "; 
//	print_r($exhibitPage); 
//	apparently returns the right exhibit page but 
//	grrrr doesn't render it! 

	exhibit_builder_render_exhibit_page($exhibitPage); 
} else { 
//	echo "Exhibit page is not empty"; 
	exhibit_builder_render_exhibit_page(); 
} 
?> 
</div>

<div id="exhibit-page-navigation">
    <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
    <div id="exhibit-nav-prev">
    <?php echo $prevLink; ?>
    </div>
    <?php endif; ?>
    <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
    <div id="exhibit-nav-next">
    <?php echo $nextLink; ?>
    </div>
    <?php endif; ?>
    <div id="exhibit-nav-up">
    <?php echo exhibit_builder_page_trail(); ?>
    </div>
</div>

<?php echo foot(); ?>

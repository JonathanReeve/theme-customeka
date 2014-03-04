<?php

/* overrides queue_css function to work with custom css function */
function elementaire_queue_css($file, $media = 'all', $conditional = false, $dir = 'css')
{
    if (is_array($file)) {
        foreach($file as $singleFile) {
            queue_css($singleFile, $media, $conditional, $dir);
        }
        return;
    }
    __v()->headLink()->appendStylesheet(elementaire_css($file, $dir), $media, $conditional);
}
/* overrides css function so that it will work with css files with the .php extension */

function elementaire_css($file, $dir = 'css')
{
    return src($file, $dir);
}

/* adapted from Griddy theme */
function elementaire_custom_background()
{
	if(function_exists('get_theme_option') && $bgimage = get_theme_option('Background Image')) {
		$storage = Zend_Registry::get('storage');
        	$bgimage_url = $storage->getUri($storage->getPathByType($bgimage, 'theme_uploads'));
	        $html = $bgimage_url;
	} else { 
		$html = ""; 
	} 
        echo $html;
}

function elementaire_custom_header_background()
{
    if(function_exists('get_theme_option') && $headerBg = get_theme_option('Header Background')) {
        $storage = Zend_Registry::get('storage');
        $headerBg = $storage->getUri($storage->getPathByType($headerBg, 'theme_uploads'));
	echo $headerBg;
    }
}

/* Custom version of ExhibitBuilder/helpers/ExhibitPageFunctions.php -> exhibit_builder_page_nav()
 * Displays all the pages, not just the parents and siblings. */ 
function elementaire_exhibit_builder_page_nav($exhibitPage = null)
{
    if (!$exhibitPage) {
        if (!($exhibitPage = get_current_record('exhibit_page', false))) {
            return;
        }
    }

    $exhibit = $exhibitPage->getExhibit();
    $html = '<ul class="exhibit-page-nav navigation" id="secondary-nav">' . "\n";
    $pagesTrail = $exhibitPage->getAncestors();
    $pagesTrail[] = $exhibitPage;
    $html .= '<li>';
    $html .= '<a class="exhibit-title" href="'. html_escape(exhibit_builder_exhibit_uri($exhibit)) . '">';
    $html .= html_escape($exhibit->title) .'</a></li>' . "\n";
    foreach ($pagesTrail as $page) {
        $linkText = $page->title;
        $pageExhibit = $page->getExhibit();
        $pageParent = $page->getParent();
        $pageSiblings = ($pageParent ? exhibit_builder_child_pages($pageParent) : $pageExhibit->getTopPages()); 
	$pageChildren = exhibit_builder_child_pages(); 

        $html .= "<li>\n<ul>\n";
        foreach ($pageSiblings as $pageSibling) {
            $html .= '<li' . ($pageSibling->id == $page->id ? ' class="current"' : '') . '>';
            $html .= '<a class="exhibit-page-title" href="' . html_escape(exhibit_builder_exhibit_uri($exhibit, $pageSibling)) . '">';
            $html .= html_escape($pageSibling->title) . "</a></li>\n";
        }
        $html .= "</ul>\n</li>\n";

        $html .= "<li>\n<ul>\n";
	foreach ($pageChildren as $pageChild) { 
            $html .= '<li' . ($pageChild->id == $page->id ? ' class="current"' : '') . '>';
            $html .= '<a class="exhibit-page-title" href="' . html_escape(exhibit_builder_exhibit_uri($exhibit, $pageChild)) . '">';
            $html .= html_escape($pageChild->title) . "</a></li>\n";
	} 
        $html .= "</ul>\n</li>\n";
    }
    $html .= '</ul>' . "\n";
    $html = apply_filters('exhibit_builder_page_nav', $html);
    return $html;
}


?>


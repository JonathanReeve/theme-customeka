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
//    disabling exhibit title in nav for now
//    $html .= '<li>';
//   $html .= '<a class="exhibit-title" href="'. html_escape(exhibit_builder_exhibit_uri($exhibit)) . '">';
//  $html .= html_escape($exhibit->title) .'</a></li>' . "\n";
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

	if($pageChildren) { 
		$html .= "<li>\n<ul>\n";
		foreach ($pageChildren as $pageChild) { 
			$html .= '<li' . ($pageChild->id == $page->id ? ' class="current"' : '') . '>';
			$html .= '<a class="exhibit-page-title" href="' . html_escape(exhibit_builder_exhibit_uri($exhibit, $pageChild)) . '">';
			$html .= html_escape($pageChild->title) . "</a></li>\n";
		} 
		$html .= "</ul>\n</li>\n";
	} 
    }
    $html .= '</ul>' . "\n";
    $html = apply_filters('exhibit_builder_page_nav', $html);
    return $html;
}

/**
 * Check if the provided exhibit page is empty (layout type = text, no text)
 *
 * @param ExhibitPage $exhibitPage
 * @return boolean
 **/
function elementaire_exhibit_page_is_empty($exhibitPage= null)
{
    if (!$exhibitPage) {
        if (!($exhibitPage = get_current_record('exhibit_page', false))) {
            return;
        }
    }

	if ($exhibitPage->layout == 'text') {
		$entries = $exhibitPage->getPageEntries();
		if ($entry = $entries[1]) {
			if (trim($entry->text) == '') {
				return true;
			}
		}
	}
	return false;
} 
/**
 * Return the first non-empty page in an exhibit, beginning with provided page
 * If provided page is non-empty, it will be immediately returned; otherwise a search
 * proceeds through the page structure to find the next non-empty page.
 *
 * @param Exhibit $exhibit
 * @param ExhibitPage|null $exhibitPage
 * @return ExhibitPage|null
 **/
function elementaire_get_first_nonempty_page($exhibit, $exhibitPage = null)
{
	// if a page is passed in, start there, otherwise load the first top page
	if (!$exhibitPage)
	{
		$topPages = $exhibit->getTopPages();
		if (count($topPages) > 0)
		{
			$exhibitPage = $topPages[0];
		}
		else
		{
			return null;
		}
	}

	// check if page is text layout, and empty
	if (elementaire_exhibit_page_is_empty($exhibitPage))
	{
		// page is empty, look for the next page
		$targetPage = null;

		if ($nextPage = $exhibitPage->firstChildOrNext())
		{
			$targetPage = $nextPage;
		}
		elseif ($exhibitPage->parent_id)
		{
			$parentPage = $exhibitPage->getParent();
			$nextParentPage = $parentPage->next();
			if ($nextParentPage)
			{
				$targetPage = $nextPage;
			}
		}

		return elementaire_get_first_nonempty_page($exhibit, $targetPage);
	}
	// page is not empty, so return it
	return $exhibitPage;
} 
?>


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
	}
        echo $html;
}

?>


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

?>

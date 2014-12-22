<?php 
/* 
 * This file contains functions for processing colors.  
 * for Elementaire 3.0. 
 * Adapted from http://lab.clearpixel.com.au/2008/06/darken-or-lighten-colours-dynamically-using-php/ 
 */ 
function colorBrightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = hex_to_rgb($hex); 
	//// CALCULATE 
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	//$hex = '';
	//for($i=0; $i < 3; $i++) {
		//// Convert the decimal digit to hex
		//$hexDigit = dechex($rgb[$i]);
		//// Add a leading zero if necessary
		//if(strlen($hexDigit) == 1) {
		//$hexDigit = "0" . $hexDigit;
		//}
		//// Append to the hex string
		//$hex .= $hexDigit;
	//}
	$hex = rgb_to_hex( $rgb ); 
	return $hash.$hex;
} 

function hex_to_rgb($hex) { 
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
	}
	return array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
} 

function rgb_to_hex($rgb) { 
	$hex = '';
	foreach ( $rgb as $rgb_color ) { 
		// Convert the decimal digit to hex
		$hexDigit = dechex( $rgb_color );
		// Add a leading zero if necessary
		if ( strlen( $hexDigit ) == 1 ) $hexDigit = "0" . $hexDigit; 
		// Append to the hex string
		$hex .= $hexDigit;
	} 
	return $hex; 
} 

/**
 * Determines whether a color appears light or not. 
 *
 * @param array
 * @return bool 
 *  - True: is a light color
 *  - False: is a dark color
 */ 
function is_light_color($rgb) { 
	return ( ( ( $rgb[0] * 0.2126 + $rgb[1] * 0.7152 + $rgb[2] * 0.0722 ) / 255.0 ) > 0.5 ); 
} 

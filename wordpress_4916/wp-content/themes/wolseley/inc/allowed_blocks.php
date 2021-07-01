<?php

if (!defined('ABSPATH')) exit;

// filters the allowed blocks


function coe__block_filter( $allowed_blocks ) {

	$editor_blocks = [
		'core/html',
		//'core/paragraph',
//		'coe/heading',
//		'coe/list',
//		'coe/file2',
//		'core/image',
//		'core/cover',
//		'core/gallery',
//		'core/spacer',
//		'core/media-text',
//		'core/quote',
//		'core/table',
//		'core/file',
//		'core/column',
//		'core/columns',
//		'core/video',
//		'core/embed',
//		'core/separator',
//		'core/shortcode'
	];

	$base_blocks = [
		'core/list',

	];


	$usable_blocks = [];

	// IF, the user has none of the required caps / roles, then....
	if ( current_user_can( 'editor' ) || current_user_can( 'administrator' )) {

		$usable_blocks = $editor_blocks;

		// else, IF
	}

//	if ( current_user_can( 'editor' )) {
//
//
//
//	} else {
//
//		$usable_blocks = $base_blocks;
//	}

	return $usable_blocks;

}


add_filter( 'allowed_block_types', 'coe__block_filter', 10, 2 );
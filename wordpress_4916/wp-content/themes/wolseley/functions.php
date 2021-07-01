<?php

// change admin bar ui logo

function wpb_custom_logo() {
    echo '
        <style type="text/css">
            #wp-admin-bar-wp-logo {
                margin-right: 16px !important;
            }
            #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
                background-image: url(' . get_bloginfo('stylesheet_directory') . '/images/Wolseley_Symbol_RGB_white_32.png) !important;
                background-position: 0 0;
                color:rgba(0, 0, 0, 0);
                width: 28px;
                display: block;
            }
            #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
                background-position: 0 0;
            }
        </style>
    ';
}

//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');

// lose the <p> tags
remove_filter( 'the_content', 'wpautop' );

// lose the emojis
//require_once get_template_directory() . '/inc/remove_emojis.php';

require_once get_template_directory() . '/inc/WoContent.php';


/**
 * Enable unfiltered_html capability for Editors.
 *
 * @param  array  $caps    The user's capabilities.
 * @param  string $cap     Capability name.
 * @param  int    $user_id The user ID.
 * @return array  $caps    The user's capabilities, with 'unfiltered_html' potentially added.
 */
function wo_add_unfiltered_html_capability_to_editors( $caps, $cap, $user_id ) {
    if ( 'unfiltered_html' === $cap && user_can( $user_id, 'editor' ) ) {
        $caps = array( 'unfiltered_html' );
    }
    return $caps;
}
add_filter( 'map_meta_cap', 'wo_add_unfiltered_html_capability_to_editors', 1, 3 );


function wo_svg_mime_type( $mimes = array() ) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'wo_svg_mime_type' );

function override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');

/*
 * Include block editor filter
 */
require get_template_directory() . '/inc/allowed_blocks.php';

// remove_filter( 'the_content', 'wpautop' );
// remove_filter( 'the_excerpt', 'wpautop' );
//remove_filter( ‘the_content’, ‘wptexturize’);


//function tinymce_remove_root_block_tag( $init ) {
//    $init['forced_root_block'] = false;
//    return $init;
//}
//add_filter( 'tiny_mce_before_init', 'tinymce_remove_root_block_tag' );
//
//add_filter('tiny_mce_before_init', 'vsl2014_filter_tiny_mce_before_init');
//
//function vsl2014_filter_tiny_mce_before_init( $options ) {
//
//    if ( ! isset( $options['extended_valid_elements'] ) ) {
//        $options['extended_valid_elements'] = 'style';
//    } else {
//        $options['extended_valid_elements'] .= ',style';
//    }
//
//    if ( ! isset( $options['valid_children'] ) ) {
//        $options['valid_children'] = '+body[style]';
//    } else {
//        $options['valid_children'] .= ',+body[style]';
//    }
//
//    if ( ! isset( $options['custom_elements'] ) ) {
//        $options['custom_elements'] = 'style';
//    } else {
//        $options['custom_elements'] .= ',style';
//    }
//
//    return $options;
//}


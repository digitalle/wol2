<?php

//get_header();

header('Content-Type: text/plain; charset=utf-8');


/*
Template Name: WO espot
Template Post Type: content
*/
while ( have_posts() ) : the_post();
    the_content();

    //get_template_part( 'template-parts/page/content', 'page' );

    // If comments are open or we have at least one comment, load up the comment template.
    // if ( comments_open() || get_comments_number() ) :
    // comments_template();
    // endif;

endwhile; // End of the loop.

//include "../css/core-css-injector.php";

//get_footer();
//  get_template_part( '../css/css-core', 'injector');  //  @TODO #refactor
//  was: include '../template-parts-base/main-block/mid_nav_mini.php';
?>











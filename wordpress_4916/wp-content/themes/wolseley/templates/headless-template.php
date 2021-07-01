<?php

/*
Template Name: WO demo2
Template Post Type: post
*/

header('Content-Type: text/plain; charset=utf-8');

?>



<?php
if ( have_posts() ) :



    /* Start the Loop */
    while ( have_posts() ) : the_post();

        /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part( 'template-parts/post/content-clear', get_post_format() );

    endwhile;

    the_posts_navigation();

else :

    get_template_part( 'template-parts/content', 'none' );

endif;


?>
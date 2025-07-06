<?php
/**
 * The main template file.
 *
 * This is the fallback template for all other templates in the theme.
 * It displays the content of the site.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content', get_post_type() );
            endwhile;

            the_posts_navigation();

        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
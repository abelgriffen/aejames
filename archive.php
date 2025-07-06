<?php
get_header(); ?>

<div class="archive-content">
    <h1><?php the_archive_title(); ?></h1>
    <div class="archive-description"><?php the_archive_description(); ?></div>

    <?php if (have_posts()) : ?>
        <ul class="archive-posts">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                </li>
            <?php endwhile; ?>
        </ul>

        <?php the_posts_navigation(); ?>
    <?php else : ?>
        <p><?php esc_html_e('No posts found.', 'vin-theme'); ?></p>
    <?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
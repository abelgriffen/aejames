<?php
/**
 * Footer template for vin-theme
 */
?>

<div class="testimonials-section">
    <h2 class="headingTitle">Feedback From Client</h2>
    <?php echo do_shortcode( '[rt-testimonial id="301" title=""]' ) ?>
</div>
<footer class="bg-light pt-4">
    <div class="container">
        <!-- Row 1: Footer Logo -->
        <div class="row">
            <div class="col text-center mb-3">
                <?php
                $footer_logo = get_theme_mod('vin_footer_logo');
                if ($footer_logo) {
                    echo '<img src="' . esc_url($footer_logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="footer-logo">';
                } elseif (function_exists('the_custom_logo') && has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<a href="' . esc_url(home_url('/')) . '" class="navbar-brand">' . get_bloginfo('name') . '</a>';
                }
                ?>
            </div>
        </div>
        <!-- Row 2: Footer Menu -->
        <div class="row">
            <div class="col text-center mb-3">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu list-inline',
                    'container'      => false,
                    'depth'          => 1,
                    'link_before'    => '<span>',
                    'link_after'     => '</span>',
                ));
                ?>
            </div>
        </div>
        <!-- Row 3: Social Media Icons -->
        <div class="row">
            <div class="col text-center mb-3">
                <?php
                $socials = get_theme_mod('vin_footer_socials', []);
                if (!empty($socials) && is_array($socials)) {
                    foreach ($socials as $social) {
                        if (!empty($social['icon']) && !empty($social['url'])) {
                            echo '<a href="' . esc_url($social['url']) . '" class="mx-2" target="_blank" rel="noopener">';
                            echo '<i class="' . esc_attr($social['icon']) . '"></i>';
                            echo '</a>';
                        }
                    }
                }
                ?>
            </div>
        </div>
        <!-- Row 4: Copyright and Designed By -->
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <?php
                echo esc_html(get_theme_mod('vin_footer_copyright', '© ' . date('Y') . ' ' . get_bloginfo('name') . '. All rights reserved.'));
                ?>
            </div>
            <div class="col-md-6 text-center text-md-end">
                Designed by <a href="<?php echo esc_url(get_theme_mod('vin_footer_designed_by_url', '#')); ?>" target="_blank"><?php echo esc_html(get_theme_mod('vin_footer_designed_by', 'Your Company')); ?></a>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
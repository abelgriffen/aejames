<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="container py-3">
    <div class="row align-items-center">
        <div class="col-6 d-flex align-items-center">
            <?php
            if (function_exists('the_custom_logo') && has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<a href="' . esc_url(home_url('/')) . '" class="navbar-brand">' . get_bloginfo('name') . '</a>';
            }
            ?>
        </div>
        <div class="col-6 text-end">
            <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0',
                        'container'      => false,
                        'fallback_cb'    => '__return_false',
                        'depth'          => 2,
                    ));
                    ?>
                </div>
            </nav>
        </div>
    </div>
</header>
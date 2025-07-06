<?php
// vin-theme functions.php

function vin_theme_enqueue_scripts() {
    // Bootstrap CSS
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css',
        array(),
        '5.3.7'
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );

    // Theme main stylesheet
    wp_enqueue_style(
        'vin-theme-style',
        get_stylesheet_uri(),
        array('bootstrap-css')
    );

    // Bootstrap JS (with Popper)
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.7',
        true
    );
}
add_action('wp_enqueue_scripts', 'vin_theme_enqueue_scripts');

function vin_theme_customize_register($wp_customize) {
    // Logo is already supported via add_theme_support('custom-logo')

    // Header Background Color Setting
    $wp_customize->add_setting('vin_theme_header_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'vin_theme_header_bg_color_control',
        array(
            'label'    => __('Header Background Color', 'vin-theme'),
            'section'  => 'colors',
            'settings' => 'vin_theme_header_bg_color',
        )
    ));

    // Nav Text Color - Normal
    $wp_customize->add_setting('vin_nav_color_normal', array(
        'default'           => '#212529',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'vin_nav_color_normal_control',
        array(
            'label'    => __('Navbar Text Color', 'vin-theme'),
            'section'  => 'colors',
            'settings' => 'vin_nav_color_normal',
        )
    ));

    // Nav Text Color - Hover
    $wp_customize->add_setting('vin_nav_color_hover', array(
        'default'           => '#0d6efd',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'vin_nav_color_hover_control',
        array(
            'label'    => __('Navbar Text Hover Color', 'vin-theme'),
            'section'  => 'colors',
            'settings' => 'vin_nav_color_hover',
        )
    ));

    // Nav Text Color - Active
    $wp_customize->add_setting('vin_nav_color_active', array(
        'default'           => '#6610f2',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'vin_nav_color_active_control',
        array(
            'label'    => __('Navbar Text Active Color', 'vin-theme'),
            'section'  => 'colors',
            'settings' => 'vin_nav_color_active',
        )
    ));

    // Footer Background Color
    $wp_customize->add_setting('vin_footer_bg_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'vin_footer_bg_color_control',
        array(
            'label'    => __('Footer Background Color', 'vin-theme'),
            'section'  => 'colors',
            'settings' => 'vin_footer_bg_color',
        )
    ));

    // Designed By
    $wp_customize->add_setting('vin_footer_designed_by', array(
        'default' => 'Your Company',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vin_footer_designed_by', array(
        'label' => __('Designed By', 'vin-theme'),
        'section' => 'title_tagline',
        'type' => 'text',
    ));

    $wp_customize->add_setting('vin_footer_designed_by_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('vin_footer_designed_by_url', array(
        'label' => __('Designed By URL', 'vin-theme'),
        'section' => 'title_tagline',
        'type' => 'url',
    ));

    // Social Media (Repeater)
    $wp_customize->add_setting('vin_footer_socials', array(
        'default' => '',
        'sanitize_callback' => function($input) {
            $input = json_decode($input, true);
            return is_array($input) ? json_encode($input) : '';
        },
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'vin_footer_socials',
        array(
            'label' => __('Footer Social Media (JSON: icon,url)', 'vin-theme'),
            'section' => 'title_tagline',
            'type' => 'textarea',
            'description' => __('Enter JSON array: [{"icon":"fab fa-facebook-f","url":"https://facebook.com"}, ...]. Use Font Awesome icon classes.', 'vin-theme'),
        )
    ));

    // Footer Logo
    $wp_customize->add_setting('vin_footer_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'vin_footer_logo',
        array(
            'label'    => __('Footer Logo', 'vin-theme'),
            'section'  => 'title_tagline',
            'settings' => 'vin_footer_logo',
        )
    ));

    // Copyright Text
    $wp_customize->add_setting('vin_footer_copyright', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vin_footer_copyright', array(
        'label' => __('Footer Copyright Text', 'vin-theme'),
        'section' => 'title_tagline',
        'type' => 'text',
    ));
}
add_action('customize_register', 'vin_theme_customize_register');

// Output custom header background color
function vin_theme_custom_header_style() {
    $header_bg = get_theme_mod('vin_theme_header_bg_color', '#ffffff');
    ?>
    <style>
        header.container {
            background-color: <?php echo esc_attr($header_bg); ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'vin_theme_custom_header_style');

// Output custom navbar colors
function vin_theme_custom_navbar_colors() {
    $normal = get_theme_mod('vin_nav_color_normal', '#212529');
    $hover = get_theme_mod('vin_nav_color_hover', '#0d6efd');
    $active = get_theme_mod('vin_nav_color_active', '#6610f2');
    ?>
    <style>
        .navbar-nav .nav-link {
            color: <?php echo esc_attr($normal); ?> !important;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus {
            color: <?php echo esc_attr($hover); ?> !important;
        }
        .navbar-nav .nav-item.active .nav-link,
        .navbar-nav .nav-link.active {
            color: <?php echo esc_attr($active); ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'vin_theme_custom_navbar_colors');

// Output custom footer background color
function vin_theme_custom_footer_style() {
    $footer_bg = get_theme_mod('vin_footer_bg_color', '#f8f9fa');
    ?>
    <style>
        footer.bg-light, footer {
            background-color: <?php echo esc_attr($footer_bg); ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'vin_theme_custom_footer_style');

class Vin_Nav_Walker extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<ul class=\"dropdown-menu\">\n";
    }
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $output .= '<li class="' . esc_attr( $class_names ) . '">';
        $output .= '<a class="nav-link" href="' . esc_attr( $item->url ) . '">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</a>';
    }
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}
// Theme support features
function vin_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'vin-theme' ),
        'footer'  => __( 'Footer Menu', 'vin-theme' ),
    ) );
}

add_action('after_setup_theme', 'vin_theme_setup');
?>
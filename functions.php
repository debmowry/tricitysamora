<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// Custom Function to Include
function favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="www.here.com" />' . "\n";
}

add_action( 'wp_head', 'favicon_link' );

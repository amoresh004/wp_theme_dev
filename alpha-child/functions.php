<?php

function alpha_child_assets(){
    wp_enqueue_style("parent-style",get_parent_theme_file_uri("/style.css"), array("alpha-bootstrap"));
}
add_action( "wp_enqueue_scripts","alpha_child_assets" );

function alpha_child_assets_dequeue(){
    wp_dequeue_style("alpha-style");
    wp_deregister_style("alpha-style");
    wp_enqueue_style( "alpha-style",get_theme_file_uri("/assets/css/alpha.css") );
}
add_action( "wp_enqueue_scripts","alpha_child_assets_dequeue",11 );
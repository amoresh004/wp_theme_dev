<?php
require_once get_theme_file_path('/inc/tgm.php');
require_once get_theme_file_path('/inc/acf-mb.php');
require_once get_theme_file_path('/inc/cmb2-mb.php');
if(site_url(  )=="http://wpthemedev.local"){
    define("VERSION",time());
} else {
    define("VERSION", wp_get_theme(  )->get("version"));
}

function alpha_bootstrapping(){
    load_theme_textdomain( "alpha");
    add_theme_support( "post-thumbnails" );
    add_theme_support( "title_tag" );
    $alpha_custom_header_details = array(
        'header-text'   =>true,
        'default-text-color'    =>'#222',
        'width'     =>1200,
        'height'    =>600,
        'flex-height'=>true,
        'flex-width'=>true,
    );
    add_theme_support( "custom-header", $alpha_custom_header_details);

    $alpha_custom_logo_defaults = array(
        "width"     =>'100',
        "height"    =>'100'
    );
    add_theme_support( "custom-logo", $alpha_custom_logo_defaults );

    add_theme_support( "custom-background" );
    register_nav_menu( "top_menu", __("Top Menu", "alpha") );
    register_nav_menu( "footer_menu", __("Footer Menu", "alpha") );

    add_theme_support( "post-formats", array("image", "video", "audio", "quote", "link") );

    add_image_size( "alpha_square", 400, 400, true); //center center
    add_image_size( "alpha_square_new1", 500, 500, true);
    add_image_size( "alpha_square_new2", 150, 150, array("right", "center") );
}
add_action("after_setup_theme", "alpha_bootstrapping");

function alpha_assets(){
    wp_enqueue_style("alpha-bootstrap", get_stylesheet_directory_uri()."/assets/css/bootstrap.min.css", null, VERSION );
    wp_enqueue_style("featherlight-style", get_stylesheet_directory_uri()."/assets/css/featherlight.min.css", null, VERSION );
    // wp_enqueue_style("bootstrap", "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
    wp_enqueue_style( "dashicon" );
    wp_enqueue_style( "font-awesome", "//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
    wp_enqueue_style("alpha-main", get_stylesheet_uri(), null, VERSION );
    wp_enqueue_style( "alpha-style",get_template_directory_uri()."/assets/css/alpha.css", null, VERSION );

    wp_enqueue_script( "featherlight-scripts", get_stylesheet_directory_uri()."/assets/js/featherlight.min.js", array("jquery"), VERSION , true );
    wp_enqueue_script( "alpha-main", get_stylesheet_directory_uri()."/assets/js/main.js", array("jquery", "featherlight-js"), VERSION, true );
}
add_action( "wp_enqueue_scripts", "alpha_assets");

function alpha_sidebar(){
    register_sidebar(
        array(
            'name'  =>__( 'Single Post Sidebar', 'alpha'),
            'id'    =>'sidebar-1',
            'description'   =>__('Right Sidebar', 'alpha'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
            )
        );

    register_sidebar(
        array(
            'name'  =>__( 'Footer Left', 'alpha'),
            'id'    =>'footer-left',
            'description'   =>__('Footer Left Widget', 'alpha'),
            'before_widget' => '<section id="%1s" class="widget %2s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
            )
        );

    register_sidebar(
        array(
            'name'  =>__( 'Footer Right', 'alpha'),
            'id'    =>'footer-right',
            'description'   =>__('Footer Right Widget', 'alpha'),
            'before_widget' => '<section id="%1s" class="widget %2s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
            )
        );
    }
add_action( "widgets_init", "alpha_sidebar" );

//Password Protected Post Using Filter Hook
// function alpha_the_excerpt( $excerpt ){
//     if(!post_password_required(  )){
//         return $excerpt;
//     } else {
//         echo get_the_password_form(  );
//     }
// }
// add_filter( "the_excerpt", "alpha_the_excerpt" );
//Password Protected Post Using Filter Hook

function alpha_protected_title_change(){
    return "%s";
}
add_filter( "protected_title_format", "alpha_protected_title_change" );

function alpha_menu_item_class($classes, $item){
    $classes[] = "list-inline-item";
    return$classes;
}
add_filter( "nav_menu_css_class", "alpha_menu_item_class", 10, 2 );

function alpha_about_page_template_banner(){
    if(is_page( )){
        $alpha_feature_image = get_the_post_thumbnail_url(null, "large");
        ?>
        <style>
            .page-header{
                background-image: url(<?php echo $alpha_feature_image;?>);
            }
        </style>
        <?php
    }

    if(is_front_page(  )){
        if( current_theme_supports( "custom-header" )){
            ?>
            <style>
                .header{
                    background-image: url(<?php echo header_image();?>);
                    background-size:cover;
                    margin-bottom:50px;
                    
                }

                .header h1.heading a, h3.tagline{
                    color:#<?php echo get_header_textcolor();?>;
                    
                    <?php
                    if(!display_header_text()){
                        echo "display:none;";
                    }
                    ?>  
                }
            </style>
            <?php
        }
    }
}
add_action( "wp_head", "alpha_about_page_template_banner", 11 );

function alpha_highlight_search_results($text){
    if(is_search()){
        $pattern = '/('. join('|', explode(' ', get_search_query())).')/i';
        $text = preg_replace($pattern, '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'alpha_highlight_search_results');
add_filter('the_excerpt', 'alpha_highlight_search_results');
add_filter('the_title', 'alpha_highlight_search_results');

// add_filter('acf/settings/show_admin', '__return_false');

function alpha_admin_assets($hook){
    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $post_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }
    if("post.php" == $hook)
    {
        $post_format = get_post_format($post_id);
        wp_enqueue_script("admin-js", get_theme_file_uri("/assets/js/admin.js"), array("jquery"), VERSION, true);
        wp_localize_script("admin-js","alpha_pf",array("format"=>$post_format));
    }
}
add_action("admin_enqueue_scripts", "alpha_admin_assets");
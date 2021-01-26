<?php
$alpha_page_layout = "col-md-12";
$alpha_text_class = "text-center";
if(is_active_sidebar( "sidebar-1" )){
    $alpha_page_layout = "col-md-8 offset-md-1";
    $alpha_text_class = "";
}
?>
<?php get_header(  ); ?>

<body <?php body_class(  ) ?>>
    <?php get_template_part( "/template-parts/common/hero" ); ?>
    <div class="container">
        <div class="row">
            <?php
        //if(is_active_sidebar( "sidebar-1" )):
            ?>
            <!-- <div class="col-md-8"> -->
            <?php
            //else:
            ?>
            <div class="<?php echo $alpha_page_layout; ?>">
                <!-- <div class="col-md-12 offset-md-1"> -->
                <?php
            //endif;
            ?>
                <div class="posts">
                    <?php
                while(have_posts(  )){
                    the_post(  );
                ?>
                    <div <?php post_class(  ) ?>>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 offset-md-1">
                                    <h2 class="post-title <?php echo $alpha_text_class;?> ">
                                        <?php the_title(  ); ?>
                                    </h2>
                                    <p class=" <?php echo $alpha_text_class;?> ">
                                        <strong><?php the_author(  ); ?></strong><br />
                                        <?php echo get_the_date(  ); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 offset-md-1">
                                    <p>
                                        <?php 
                                    if( has_post_thumbnail(  ) ){
                                        $thumbnail_url = get_the_post_thumbnail_url(null, "large");
                                        echo '<a href="'.$thumbnail_url.'" data-featherlight="image">';
                                        the_post_thumbnail( "large", "class='img-fluid'" );
                                        echo '</a>';
                                    }
                                    
                                    the_content(  );
                                    if(get_post_format( ) == "image" && class_exists("CMB2") ):
                                    ?>
                                    <div class="metainfo">

                                    <?php
                                    $alpha_camera_model = get_post_meta(get_the_ID(), "_alpha_camera_model",true);
                                    $alpha_date = get_post_meta(get_the_ID(), "_alpha_date",true);
                                    $alpha_location = get_post_meta(get_the_ID(), "_alpha_location",true);
                                    $alpha_licence = get_post_meta(get_the_ID(), "_alpha_licence",true);
                                    $alpha_licence_information = get_post_meta(get_the_ID(), "_alpha_licence_information",true);
                                    ?>
                                        <strong>Camera Model:</strong> <?php echo esc_html($alpha_camera_model); ?></br>
                                        <strong>Location:</strong>
                                        <?php
                                        echo esc_html( $alpha_location );
                                        ?></br>
                                        <strong>Date:</strong> <?php echo esc_html( $alpha_date ); ?></br>
                                        <?php if($alpha_licence):?>
                                            <strong>Licence Information:</strong>
                                        <?php
                                        echo apply_filters( "the_content", $alpha_licence_information );
                                         endif; ?>
                                        <?php endif; ?>
                                        <p>
                                        <?php
                                            $alpha_image = get_post_meta(get_the_ID(),"_alpha_image_id", true);
                                            $alpha_image_details = wp_get_attachment_image_src($alpha_image, "alpha-square");
                                            echo "<img src='".esc_url($alpha_image_details[0])."' />";
                                        ?>
                                        </p>
                                        <p>
                                        <?php
                                            $alpha_file = get_post_meta(get_the_ID(),"_alpha_resume", true);
                                            echo esc_url($alpha_file);
                                        ?>
                                        </p>
                                    </div>
                                    <?php
                                    wp_link_pages(  );
                                    ?>
                                    <!-- <div class="next-post"><?php next_post_link(  ); ?></div>
                                    <div class="previous-post"><?php previous_post_link(  ); ?></div> -->
                                    </p>
                                </div>
                                <div class="authorsection">
                                    <div class="row">
                                        <div class="col-md-3 authorimage">
                                            <?php echo get_avatar( get_the_author_meta("ID") ); ?>
                                        </div>
                                        <div class="col-md-9">
                                            <h1><?php echo get_the_author_meta("display_name"); ?></h1>
                                            <p><?php echo get_the_author_meta("description"); ?></p>
                                            <?php if(function_exists("the_field")): ?>
                                            <p>
                                                Facebook Url: <a href="facebook.com/amoresh004"><?php the_field("facebook","user_".get_the_author_meta("ID")); ?></a><br />
                                                Twitter Url: <a href="twitter.com/amrechchandraR"><?php the_field("twitter","user_".get_the_author_meta("ID")); ?></a><br />
                                            </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if(comments_open(  )){ ?>
                                <div class="col-md-10 offset-md-1">
                                    <?php
                                    comments_template(  );
                                ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php
        if(is_active_sidebar( "sidebar-1" )):
        ?>
            <div class="col-md-3 sidebar-1">
                <?php
                if(is_active_sidebar( "sidebar-1" )){
                    dynamic_sidebar( "sidebar-1" );
                }
            ?>
            </div>
            <?php
        endif;
        ?>
        </div>
    </div>
    <?php get_footer(  ); ?>

    <?php if(function_exists("name")){
        $alpha_image = "image";
    }

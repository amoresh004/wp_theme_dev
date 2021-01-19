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
                                    <strong><?php the_author(  ); ?></strong><br/>
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
                                                
                                    //Featherlight post thumbnail image view using internal js file
                                    // if( has_post_thumbnail(  ) ){
                                    //     $thumbnail_url = get_the_post_thumbnail_url( null, "large");
                                    //     echo '<a class="popup" href=" # " data-featherlight="image">';
                                    //     the_post_thumbnail( "large", array("class=>'img-fluid'" ));
                                    //     echo '</a>';
                                    // }
                                    //Featherlight post thumbnail image view using internal js file

                                    the_content(  );
                                    if(get_post_format( ) == "image" && function_exists("the_field") ):
                                    ?>
                                    <div class="metainfo">
                                        <strong>Camera Model:</strong> <?php the_field("camera_model"); ?></br>
                                        <strong>Location:</strong>
                                        <?php
                                        $alpha_location = get_field("location");
                                        echo esc_html( $alpha_location );
                                        ?></br>
                                        <strong>Date:</strong> <?php the_field("date"); ?></br>
                                         <?php if(get_field("licensed")):?>
                                        <strong>Licence Information:</strong>
                                        <?php
                                        echo apply_filters( "the_content", get_field("licence_information") );
                                         endif; ?>
                                        <p>
                                         <?php 
                                         $alpha_image = get_field("image");
                                         $alpha_image_details = wp_get_attachment_image_src( $alpha_image, "alpha_square");
                                            echo "<img src='". esc_url( $alpha_image_details[0] )."'/>";
                                         ?>
                                        <?php endif; ?>
                                        </p>
                                        <?php
                                            $file = get_field( "attachment" );
                                            if($file){
                                                $file_url = wp_get_attachment_url( $file );
                                                $file_thumbnail = get_field("thumbnail", $file);
                                                if($file_thumbnail){
                                                    $file_thumbnail_details = wp_get_attachment_image_src( $file_thumbnail );
                                                    echo "<a target='_blank' href='{$file_url}'><img src='". esc_url( $file_thumbnail_details[0] )."' /></a>";
                                                }
                                                else {
                                                    echo "<a target='_blank' href='{$file_url}'>{$file_url}</a>";
                                                }
                                            }
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
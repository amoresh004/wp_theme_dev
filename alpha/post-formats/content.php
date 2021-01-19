<div <?php post_class(  ) ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(  ); ?></a>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p>
                        <strong><?php the_author(  ); ?></strong><br/>
                        <?php echo get_the_date(  ); ?>
                    </p>
                   <?php echo get_the_tag_list( "<ul></ul>", " ,</br> ", "<ul></ul>" ); ?>
                </div> 
               
                <div class="col-md-8">
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

                        // if(has_post_thumbnail()){
                        //     the_post_thumbnail( "large", "class='img-fluid'" );
                        // }
                        // the_excerpt(  );

                        //Password Protected Post Using Normal if else
                        if(!post_password_required(  )){
                           the_excerpt(  );
                        } else {
                            echo get_the_password_form(  );
                        }
                        //Password Protected Post Using Normal if else

                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_header(  ); ?>
<body <?php body_class(  ) ?>>
<?php get_template_part( "/template-parts/common/hero" ); ?>
<div class="posts">
    <?php
    while(have_posts()){
        the_post(  );
        get_template_part( "post-formats/content", get_post_format() );

     } 
     ?>

   <div class="container post-pagination">
       <div class="row">
           <div class="col-md-6"> </div>
           <div class="col-md-6">
               <?php 
                the_posts_pagination( array(
                    "screen_reader_text"=>' '
                ) );
               ?>
           </div>
       </div>
   </div>
</div>
<?php get_footer(  ); ?>
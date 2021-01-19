<?php get_header(  ); ?>
<body <?php body_class(  ) ?>>
<?php get_template_part( "/template-parts/common/hero" ); ?>
<div class="posts text-center">
    <h2>Post Under 
    <?php
    if(is_month()){
        $month = get_query_var( "monthnum" );
        $dateobj = DateTime::createFromFormat("!m",$month);
        echo $dateobj->format("F");
        }
        else if(is_year()){
            echo esc_html(get_query_var("year"));
        }
     else if(is_day()){
        $day = esc_html( get_query_var( "day" ) );
        $month = esc_html( get_query_var( "monthnum" ) );
        $year = esc_html( get_query_var( "year" ) );
        // echo get_query_var("day"),"/".get_query_var("monthnum"),"/".get_query_var("year");
        // printf("%s/%s/%s",get_query_var( "day" ),get_query_var( "monthnum" ),get_query_var( "year" ));
        printf("%s/%s/%s",$day, $monthnum, $year);
    }
    ?>
    </h2>
    <?php
    while(have_posts()){
        the_post(  );
        ?>
        <h2><a href="<?php the_permalink(  );?>"><?php the_title(  );?></a></h2>
        <?php
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
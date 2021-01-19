<?php
single_cat_title( );
$alpha_current_term = get_queried_object();
$alpha_term_thumbnail_id = get_field("thumbnail",$alpha_current_term);
if($alpha_term_thumbnail_id){
    $alpha_file_thumbnail_details = wp_get_attachment_image_src( $alpha_term_thumbnail_id );
    echo "<br><img src='".esc_url( $alpha_file_thumbnail_details[0] )."'/>"; 
}
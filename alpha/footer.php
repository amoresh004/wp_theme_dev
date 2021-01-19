
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-left col-md-3">
               <?php
                if(is_active_sidebar( "footer-left" )){
                    dynamic_sidebar( "footer-left" );
                }
               ?>
            </div>
            <div class="footer-container col-md-6">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'  =>__( 'footer_menu'),
                        'menu_id'    =>'footer-menu-container',
                        'menu_class'   =>__('list-inline text-center'),
                        )
                    );
                ?>
            </div>
            <div class="footer-right col-md-3">
                <?php
                if(is_active_sidebar( "footer-right" )){
                    dynamic_sidebar( "footer-right" );
                }
                ?>
            </div>      
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>
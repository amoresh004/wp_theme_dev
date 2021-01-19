<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(wp_get_theme("custom-logo")):
                ?>
                <div class="header-logo text-center">
                    <?php the_custom_logo(  );?>
                </div>
                <?php
                endif;
                ?>
                <h3 class="tagline"><?php bloginfo( "description" ) ?></h3>
                <h1 class="align-self-center display-3 text-center heading">
                    <a href="<?php echo site_url(); ?>"><?php bloginfo( "name" ) ?></a>
                </h1>
            </div>
            <div class="col-md-12">
                <div class="navigation">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  =>__( 'top_menu'),
                            'menu_id'    =>'top-menu-container',
                            'menu_class'   =>__('list-inline text-center'),
                            )
                        );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
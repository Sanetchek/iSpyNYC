<aside id="page-wrap">
    <div id="left-sidebar-btn" class="fa fa-bars fa-2x"></div>
    <div id="sidebar" class="display-sidebar">

        <?php get_template_part( 'poston' ); ?>
        
        <?php if ( is_search() ) : ?>

            <?php get_search_form(); ?>

        <?php else: ?>    
            <div class="date">
                <script language="javascript" type="text/javascript" src="<?php bloginfo('template_url') ?>/js/date.js"></script>
            </div>
        <?php endif; ?>

        <?php get_template_part( 'downapp' ); ?>
    </>
</aside>
<aside id="page-wrap">
    <div id="left-sidebar-btn" class="fa fa-bars fa-2x"></div>
    <div id="sidebar" class="display-sidebar">

        <?php get_template_part( 'poston' ); ?>
        
        <?php if ( is_search() ) : ?>

            <?php get_search_form(); ?>

        <?php else: ?>    
            <div class="date">
                <div class="month"></div>
                <div class="day"></div>
            </div>
        <?php endif; ?>

        <?php get_template_part( 'downapp' ); ?>
    </>
</aside>
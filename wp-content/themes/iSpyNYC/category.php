<?php get_header(); ?>
<?php get_sidebar(); ?>

    <div id="content">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	        <?php get_template_part( 'loop' ); ?>

        <?php endwhile; ?>
            <?php if (function_exists(wp_corenavi)) {
                wp_corenavi();
            } ?>
        <?php else: ?>
            <h2 class="tempsearch"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></h2>
        <?php endif; ?>

    </div>

<?php get_template_part( 'ads' ) ?>
<?php get_footer(); ?>
<?php get_header(); ?>
<?php get_sidebar(); ?>

    <div id="content">
        <div class="search-result">
            <h4>Search results: <?php global $wp_query;
                                        echo $wp_query->found_posts; ?> post(s)</h4>
        </div>

        <?php if ( have_posts() ): ?>
            <?php while ( have_posts() ): the_post(); ?>

                <?php get_template_part( 'loop' ); ?>

            <?php endwhile; ?>
            <?php if (function_exists(wp_corenavi)) {
                wp_corenavi();
            } ?>
        <?php else: ?>
            <h2 class="tempsearch"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></h2>
        <?php endif ?>
    </div>

<?php get_template_part( 'ads' ) ?>
<?php get_footer(); ?>
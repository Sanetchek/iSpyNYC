<?php get_header(); ?>
<?php get_sidebar(); ?>

    <div id="content">
        <?php
            $loop_paged = (get_query_var('page')) ? get_query_var('page') : $paged;
            query_posts('cat=0&paged=' . $loop_paged);
        ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php
		            get_template_part( 'loop' );
		        ?>

            <?php endwhile; ?>
                <?php wp_corenavi(); ?>
            <?php wp_reset_postdata(); ?>

        <?php else:  ?>
            <h2 class="tempsearch"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></h2>
        <?php endif; ?>

    </div>

<?php get_template_part( 'ads' ) ?>
<?php get_footer(); ?>
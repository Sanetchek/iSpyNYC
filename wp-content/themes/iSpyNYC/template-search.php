<?php
/*
 *  Template Name: Search
 */
?>

<?php get_header(); ?>
<?php get_template_part( 'tempsearch' ) ?>

    <div id="content">
        <?php
        $loop_paged = (get_query_var('page')) ? get_query_var('page') : $paged;
        query_posts('posts_per_page=4&paged=' . $loop_paged);
        ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                get_template_part( 'loop' );
                ?>

            <?php endwhile; ?>
            <?php if (function_exists(wp_corenavi)) {
                wp_corenavi();
            } ?>

        <?php else:  ?>
            <h2 class="tempsearch"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></h2>
        <?php endif; ?>
    </div>

<?php get_template_part( 'ads' ) ?>
<?php get_footer(); ?>
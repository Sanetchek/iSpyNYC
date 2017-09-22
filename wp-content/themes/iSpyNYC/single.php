<?php get_header(); ?>

<?php get_sidebar(); ?>

    <div id="content">
        <?php if (have_posts()) : while (have_posts()) : the_post();

            get_template_part( 'template-parts/content/content-popup' );

        endwhile; ?>

        <?php else: ?>
            <!-- no posts found -->
        <?php endif; ?>


    </div>

<?php get_template_part('ads'); ?>

<?php get_footer(); ?>
<?php get_header(); ?>

<?php get_sidebar(); ?>

    <div id="content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" class="article">
                <h1><?php the_title(); ?></h1>
                <div class="paragraph"><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>

        <?php else: ?>
            <!-- no posts found -->
        <?php endif; ?>
    </div>

<?php get_template_part('ads'); ?>

<?php get_footer(); ?>
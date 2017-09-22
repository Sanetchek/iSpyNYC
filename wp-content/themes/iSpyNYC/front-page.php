<?php get_header(); ?>
<?php get_sidebar(); ?>

    <div id="content">
        <?php $filterBy = $_GET['filterBy']; // filtering by author_name ?>

        <form method="get">
            <select name="filterBy">
                <option value="ispy">Aleksandr Gryshko</option>
                <option value="sasha">sasha</option>
            </select>
            <input type="submit" value="Submit the form"/>
       </form> <!--  filter form -->


        <?php
            $loop_paged = (get_query_var('page')) ? get_query_var('page') : $paged;
            query_posts('author_name=' . $filterBy . '&cat=0&paged=' . $loop_paged);
        ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php
		            get_template_part( 'loop' );
		        ?>

            <?php endwhile; ?>
                <?php wp_corenavi(); ?>
        <?php else:  ?>
            <h2 class="tempsearch"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></h2>
        <?php endif; ?>

        <?php wp_reset_query(); ?>

    </div>

<?php get_template_part( 'ads' ) ?>
<?php get_footer(); ?>
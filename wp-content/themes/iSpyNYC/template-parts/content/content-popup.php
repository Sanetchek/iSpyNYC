<div id="ispy-modal">
    <div class="modal"></div>
    <span class="close">&times;</span>
    <div class="modal-content">

        <article id="post-<?php the_ID(); ?>" class="article single-post">
            <div class="images">
                <?php get_template_part( 'template-parts/media/media-popup' ); ?>
            </div>

            <div class="meta">
                <h4>
                    <span><?php the_author(); ?></span>
                    <hr>
                </h4>
                <div><span class="subject">Subject:</span> <?php echo the_category(', '); ?></div>
                <div><span class="title">Title:</span> <h2><?php the_title(); ?></h2></div>
                <?php if( get_post_meta($post->ID, 'location_field', true) ): ?>
                    <div><span class="location">Location:</span>
                        <?php echo get_post_meta($post->ID, 'location_field', true); ?>
                    </div>
                <?php endif; ?>
                <div><span class="date">Date:</span> <?php the_time( 'F d, Y' ); ?></div>
            </div>

            <div class="paragraph ext"><?php the_content(); ?></div>

            <div class="comment_form">
                <span class="show-a-comment">Add a comments</span>
                <div class="form">
                    <?php
                    global $withcomments;
                    $withcomments = true;
                    comments_template();
                    ?>
                </div>
            </div>
        </article>
    </div>
</div>
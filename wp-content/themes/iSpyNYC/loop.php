<article id="post-<?php the_ID(); ?>" class="article">
	<div class="images">
        <?php get_template_part( 'media' ); ?>
	</div>
	<div class="meta">
		<div><span class="subject">Subject:</span> <?php echo the_category(' , '); ?></div>
		<div><span class="title">Title:</span> <?php the_title(); ?></div>
		<div><span class="location">Location:</span>
			<?php echo get_post_meta($post->ID, '_location_value_key', true); ?>
		</div>
		<div><span class="date">Date:</span> <?php the_time( 'F d, Y' ); ?></div>
		<div><span class="author">Author:</span> <?php the_author(); ?></div>
	</div>
    <div class="clear"></div>
	<div class="paragraph" style="max-height: 37px;">
        <?php the_content(); ?>
    </div>
    <div class="read-more">read more</div>

	<div class="comment_form">
		<span class="add-a-comment">Show comments </span>
        <?php comments_number('', '(1)', '(%)'); ?>
		<div class="text" style="display: none;">
			<?php
                global $withcomments;
                $withcomments = true;
                comments_template();
			?>
		</div>
	</div>
</article>
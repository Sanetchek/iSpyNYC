<article id="post-<?php the_ID(); ?>" class="article">
	<h4>
		<?php
		$comment = get_the_author_meta('user_email');
		echo get_avatar( $comment, 30 );
		?>
        <span><?php the_author(); ?></span>
        <hr>
    </h4>
	<div class="images">
        <?php get_template_part( 'media' ); ?>
	</div>
	<div class="meta">
		<div><span class="subject">Subject:</span> <?php echo the_category(', '); ?></div>
		<div><span class="title">Title:</span> <h2><?php the_title(); ?></h2></div>

		<?php if( get_post_meta($post->ID, 'location_field', true) ): ?>
			<div><span class="location">Location:</span>
				<?php echo get_post_meta($post->ID, 'location_field', true); ?>
			</div>
		<?php endif; ?>

		<div><span class="date">Date:</span> <?php the_time( 'F d, Y' ); ?></div>
	</div>
    <div class="clear"></div>
	<div class="paragraph" style="max-height: 42px;">
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
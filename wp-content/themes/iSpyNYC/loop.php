<article id="post-<?php the_ID(); ?>" class="article">
	<h4>
        <span><?php the_author(); ?></span>
        <hr>
    </h4>
	<div class="images">
        <?php get_template_part( 'template-parts/media/media' ); ?>
        <div class="preloader"
             data-page="<?php the_ID(); ?>"
             data-url="<?php echo admin_url('admin-ajax.php'); ?>">
        </div>
        <div class="content-preload">
            <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
        </div>
	</div>
	<div class="meta">
		<div><span class="subject">Subject:</span> <?php echo the_category(', '); ?></div>
		<div><span class="title">Title:</span> <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></div>

		<?php if( get_post_meta($post->ID, 'location_field', true) ): ?>
			<div><span class="location">Location:</span>
				<?php echo get_post_meta($post->ID, 'location_field', true); ?>
			</div>
		<?php endif; ?>

		<div><span class="date">Date:</span> <?php the_time( 'F d, Y' ); ?></div>
	</div>
    <div class="clear"></div>
	<div class="paragraph" style="max-height: 42px;">
		<div class="paragraph-wrap">
        	<?php the_content(); ?>
        </div>
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

<!--	<a class="ispy-popup" style="float: none;" data-page="--><?php //the_ID(); ?><!--" data-url="--><?php //echo admin_url('admin-ajax.php'); ?><!--">Load Popup</a>-->
</article>
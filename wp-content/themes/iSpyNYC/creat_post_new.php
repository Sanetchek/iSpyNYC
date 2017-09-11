<?php
/**
 * Template Name: New post
 *
 * @uses Advanced Custom Fields Pro
 */

/**
 * Добавить  обязательную функцию acf_form_head() в самый верх страницы
  */?>
<?php acf_form_head();?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php the_post();?>


    <div id="content">
		<article class="article single-post">
		    <h1>Post on iSpyNYC:</h1>
            <?php if ( !( is_user_logged_in()  ) ) {?>
                <a href="<?php echo site_url('wp-login.php', 'login_post') ?>" class="btn">Login</a>
                <a href="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="btn">Register</a>
            <?php  } else {
                $new_post = array(
                    'post_id' => 'new', // Создать новый пост
                    'field_groups' => array(233, 343, 61, 237, 239), // Группы полей для создания поста
                    'form' => true,
                    'return' => '%post_url%', // Переадресация на url созданного поста
                    'html_before_fields' => '',
                    'html_after_fields' => '',
                    'submit_value' => 'Publish',
                    'updated_message' => 'Saved!!!'
                );
                acf_form($new_post);
            } ?>

		</article><!-- #content -->
	</div><!-- #container -->

<?php get_template_part('ads'); ?>

<?php get_footer(); ?>
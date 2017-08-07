<aside id="advertise">
    <div class="ads">
        <?php if( !dynamic_sidebar('ads') ) : ?>
            <div><a href="#"><img src="<?php bloginfo('template_url') ?>/images/Layer18.png" alt="18" width="94px"></a></div>
            <div><a href="#"><img src="<?php bloginfo('template_url') ?>/images/Layer16.png" alt="16" width="94px"></a></div>
            <div><a href="#"><img src="<?php bloginfo('template_url') ?>/images/Layer17.png" alt="17" width="94px"></a></div>
            <div><a href="#"><img src="<?php bloginfo('template_url') ?>/images/Layer15.png" alt="15" width="94px"></a></div>
        <?php endif; ?>

        <footer id="footer-menu">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer-menu',
            ) );
            ?>
            <p>Property of © BUZZARt LLC.,<br>All rights reserved.</p>
        </footer>
    </div>
</aside>
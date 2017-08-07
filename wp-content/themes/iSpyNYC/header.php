<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iSpy NYC</title>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- [if lt IE]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        div#html5-elem-data-box {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <?php wp_head() ?>
</head>

<body>
    <header id="header">
        <div class="head-bg">
            <div id="head-wrap">
                <div id="logo" class="container">
                    <a href="<?php echo get_home_url(); ?>"><img
                            src="<?php bloginfo('template_url') ?>/images/iSpy.svg" alt="logo"></a>
                    <div class="logoright">
                        <?php if (!is_user_logged_in()){ ?>
                            <a href="<?php echo wp_login_url(); ?>" title="Login">Login</a><span> | </span>
                            <?php wp_register('', ''); ?>
                        <?php } else { ?>
                            <span>
                                Hello, <?php $user_info  = wp_get_current_user();
                                echo $user_info->user_login; ?> |
                            </span>
                            <a href="<?php echo wp_logout_url(home_url()); ?>">logout</a><br />
                        <?php }?>
                    </div>
                </div>
                <div id="menu">
                    <nav class="container">
                        <ul id="left" class="display-menu">
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                            ) );
                            ?>
                        </ul>
                        <ul id="right" class="display-menu">
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'feedback',
                            ) );
                            ?>
                        </ul>
                        <div id="menu-btn" class="fa fa-bars"> MENU</div>
                    </nav>
                </div>
            <div class="head-line"></div>
        </div>
        </div>
    </header>

<main id="main" class="container clear">
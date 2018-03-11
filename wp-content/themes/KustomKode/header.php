<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<?php if ($post->post_status  !== "publish") { ?>
    <meta name='robots' content='noindex,follow'/>
<?php } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="topbar">
    <div class="inner clearfix">
        <div class="soc-wrap">
            <?php
                    if(get_option('company_facebook')){ ?>
			            <a href="<?php echo do_shortcode('[company-facebook]'); ?>" target="_blank" class="soc first hvr-pop"><span class="icon"><i class="fab fa-facebook-square"></i></span></a><?php
                    } 
                    if(get_option('company_twitter')){ ?>
			            <a href="<?php echo do_shortcode('[company-twitter]'); ?>" target="_blank" class="soc hvr-pop"><span class="icon"><i class="fab fa-twitter-square"></i></span></a><?php
                    }
                    if(get_option('company_linkedin')){ ?>
			            <a href="<?php echo do_shortcode('[company-linkedin]'); ?>" target="_blank" class="soc hvr-pop"><span class="icon"><i class="fab fa-linkedin"></i></span></a><?php
                    }
                    if(get_option('company_google_plus')){ ?>
			            <a href="<?php echo do_shortcode('[company-google-plus]'); ?>" target="_blank" class="soc hvr-pop"><span class="icon"><i class="fab fa-google-plus-square"></i></span></a><?php
                    }
            ?>
        </div>
    </div>
</div>
<header>
    <div class="inner clearfix">
        <a class="logo" href="<?php echo get_home_url(); ?>" title="Home">
            <img width="281" height="57" src="<?php echo home_url('wp-content/uploads/logo.svg'); ?>" alt="<?php echo do_shortcode('[company-name]'); ?>" />
        </a>
        <?php
            if(get_option('company_phone')){ ?>
                <p class="ph"><a href="tel:<?php echo do_shortcode('[company-phone-link]'); ?>"><?php echo do_shortcode('[company-phone]'); ?></a></p><?php
            }
        ?>
    </div><!--End div class inner-->
</header>
<?php get_template_part('main-menu'); ?>
<?php get_template_part('slideshow'); ?>
<div class="wrap">
<div class="inner clearfix">
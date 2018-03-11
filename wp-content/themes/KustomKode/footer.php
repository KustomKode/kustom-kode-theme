</div><!--end div id innerwrap-->
</div><!--end div id wrap-->
<footer class="bbox">
    <div class="inner clearfix">
        <div class="fbox bbox">
            <p class="fboxtitle">Contact Information</p>
            <?php
                if(get_option('company_name')) echo '<p><strong>'.get_option('company_name').'</strong>';
                if(get_option('company_add')) echo '<br />'.get_option('company_add');
                if(get_option('company_add_line_two')) echo '<br />'.get_option('company_add_line_two');
                if(get_option('company_city')) echo '<br />'.get_option('company_city');
                if(get_option('company_state')) echo ', '.get_option('company_state').' ';
                if(get_option('company_zip')) echo get_option('company_zip');
                if(get_option('company_phone')) echo '<br /><a href="tel:'.do_shortcode('[company-phone-link]').'">'.do_shortcode('[company-phone]').'</a>';
                if(get_option('company_fax')) echo '<br /><a href="tel:'.get_option('company_fax').'">'.get_option('company_fax').'</a>';
                if(get_option('company_email')) echo '<br /><a href="mailto:'.get_option('company_email').'">'.get_option('company_email').'</a>';
                if(get_option('company_name')) echo '</p>';
            ?>
        </div>
        <div class="fbox bbox">
            <p class="fboxtitle">Site Navigation</p>
            <nav class="footermenu">
                <?php wp_nav_menu(array('theme_location' => 'footer-menu')); ?>
            </nav>
        </div>
        <div class="fbox bbox">
            <p class="fboxtitle">Socialize With Us</p>
			<div class="footersocial">
				<p class="clearfix">
				    <?php
                	    if(get_option('company_facebook')){ ?>
                    	    <a href="<?php echo do_shortcode('[company-facebook]'); ?>" target="_blank" class="footer-social facebook wow fadeIn" data-wow-delay="0.25s"><i class="fab fa-facebook-square fa-2x"></i></a><?php
					    }
               	        if(get_option('company_twitter')){ ?>			
                 	        <a href="<?php echo do_shortcode('[company-twitter]'); ?>" target="_blank" class="footer-social twitter wow fadeIn" data-wow-delay="0.5s"><i class="fab fa-twitter-square fa-2x"></i></a><?php
					    }
                	    if(get_option('company_linkedin')){ ?>			
                         <a href="<?php echo do_shortcode('[company-linkedin]'); ?>" target="_blank" class="footer-social linkedin wow fadeIn" data-wow-delay="0.75s"><i class="fab fa-linkedin fa-2x"></i></a><?php
					    }
                	    if(get_option('company_google_plus')){ ?>			
                    	    <a href="<?php echo do_shortcode('[company-google-plus]'); ?>" target="_blank" class="footer-social googleplus wow fadeIn" data-wow-delay="1s"><i class="fab fa-google-plus-square fa-2x"></i></a><?php
					    }
				    ?>
				</p>
            </div>
        </div>
    </div>
</footer>
<div class="copyrightwrap bbox">
    <div class="inner clearfix">
        <?php
            if(get_option('company_name')){
                echo '<p class="copyright">Copyright &copy; '.date('Y').' - '.get_option('company_name').' - All Rights Reserved.</p>';
            } else {
                echo '<p class="copyright">Copyright &copy; '.date('Y').' - KustomKode.com - All Rights Reserved.</p>';
            }
        ?>
        <p class="webdesign"><?php get_template_part('kustom-kode-logo'); ?></p>
    </div>
</div>
<a class="back2top" title="Back to the Top" href="#"></a>
<?php wp_footer(); ?>
</body>
</html>
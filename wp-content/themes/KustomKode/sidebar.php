<?php 
    if(is_page_template('page-sidebar-right.php')){
        $class = 'sidebar-right';
    } else {
        $class = 'sidebar-left';
    }
?>
<aside class="<?php echo $class; ?>">
    <div class="form bbox clearfix"><?php echo do_shortcode('[contact-form-7 id="100" title="sidebar-form"]'); ?></div>
</aside>
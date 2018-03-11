<?php
    get_header();
?>

<section class="sitecontent">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'entry' ); ?>
    <?php endwhile; endif; ?>
    <?php get_template_part( 'nav', 'below-single' ); ?>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
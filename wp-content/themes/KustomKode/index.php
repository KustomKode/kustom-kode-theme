<?php get_header(); ?>
<section class="sitecontent">
    <?php while ( have_posts() ) : the_post() ?>
    <?php get_template_part( 'entry' ); ?>
    <?php endwhile; ?>
    <?php get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
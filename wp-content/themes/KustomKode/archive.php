<?php get_header(); ?>
<section class="sitecontent">
<?php the_post(); ?>
<?php if ( is_day() ) : ?>
<h1 class="page-title"><?php printf( __( 'Daily Archives: %s', 'KustomKode' ), '<span>' . get_the_time(get_option('date_format')) . '</span>' ) ?></h1>
<?php elseif ( is_month() ) : ?>
<h1 class="page-title"><?php printf( __( 'Monthly Archives: %s', 'KustomKode' ), '<span>' . get_the_time('F Y') . '</span>' ) ?></h1>
<?php elseif ( is_year() ) : ?>
<h1 class="page-title"><?php printf( __( 'Yearly Archives: %s', 'KustomKode' ), '<span>' . get_the_time('Y') . '</span>' ) ?></h1>
<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
<h1 class="page-title"><?php _e('Blog Archives', 'KustomKode' ); ?></h1>
<?php endif; ?>
<?php rewind_posts(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
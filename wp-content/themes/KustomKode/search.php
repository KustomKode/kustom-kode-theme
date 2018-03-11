<?php
    get_header();
?>

<section class="fullsitecontent">
    <?php if ( have_posts() ) : ?>
        <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'KustomKode' ), '<span>' . get_search_query()  . '</span>' ); ?></h1>
        <?php while ( have_posts() ) : the_post() ?>
            <?php get_template_part( 'entry' ); ?>
        <?php endwhile; ?>
        <?php get_template_part( 'nav', 'below' ); ?>
    <?php else : ?>
        <div id="post-0" class="post no-results not-found">
            <h2 class="entry-title"><?php _e( 'Nothing Found', 'KustomKode' ) ?></h2>
            <div class="entry-content">
                <p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'KustomKode' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
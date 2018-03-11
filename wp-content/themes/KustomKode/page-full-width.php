<?php
    /* Template Name: Full Width */
    get_header();
?>

<section class="sitecontent">
    <?php the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="entry-content clearfix">
            <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                } 
                the_content();
                wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'KustomKode' ) . '&after=</div>');
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
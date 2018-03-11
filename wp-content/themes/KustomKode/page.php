<?php
    get_header();
?>

<section class="sitecontent right">
    <?php the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="entry-content">
            <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                } 
                the_content();
                wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'KustomKode' ) . '&after=</div>');
            ?>
        </div>
    </div>
    <!--<?php comments_template( '', true ); ?>-->
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
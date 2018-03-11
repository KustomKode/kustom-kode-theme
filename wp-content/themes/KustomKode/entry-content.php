<div class="entry-content clearfix">
<?php if ( has_post_thumbnail() ) {
    the_post_thumbnail();
} ?>
<?php the_content(); ?>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'KustomKode' ) . '&after=</div>') ?>
</div>
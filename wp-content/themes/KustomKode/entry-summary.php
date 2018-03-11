<div class="entry-summary">
<?php the_excerpt( sprintf(__( 'continue reading %s', 'KustomKode' ), '<span class="meta-nav">&raquo;</span>' )  ); ?>
<?php if(is_search()) {
wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'KustomKode' ) . '&after=</div>');
}
?>
</div> 
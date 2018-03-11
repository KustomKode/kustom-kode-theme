<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { 
    post_pagination();
} ?>
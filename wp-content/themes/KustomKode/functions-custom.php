<?php
/*
function enqueue_custom_admin_scripts() {
    global $post_type;
    if('reviews' == $post_type){
        wp_register_style('admin_css', get_template_directory_uri() . '/css/admin_css.css');
        wp_enqueue_style( 'admin_css');
    }
}
add_action( 'admin_enqueue_scripts', 'enqueue_custom_admin_scripts' );

// ADDS THE NEW POST TYPE CALLED "reviews" TO THE THEME ===>
add_action( 'init', 'reviews_post_type', 0 );
function reviews_post_type() {
	$labels = array(
            'name' => __( 'Reviews' ),
            'singular_name' => __( 'Review' ),
            'add_new' => __( 'New Review' ),
            'add_new_item' => __( 'Add New Review' ),
            'edit_item' => __( 'Edit Review' ),
            'new_item' => __( 'New Review' ),
            'view_item' => __( 'View Review' ),
            'search_items' => __( 'Search Reviews' ),
            'not_found' =>  __( 'No Reviews Found' ),
            'not_found_in_trash' => __( 'No Review Found in Trash' ),
	);
	$args = array(
	    'labels'               => $labels,
            'has_archive'          => false,
            'hierarchical'         => false,
            'capability_type'      => 'post',
            'show_ui'              => true,
            'show_in_menu'         => true,
            'menu_position'        => 20,
            'exclude_from_search'  => true,
            'query_var'            => true,
            'menu_icon'            => 'dashicons-format-quote',
            'public'               => false,
            'publicly_queryable'   => true,
            'rewrite'              => array('reviews' => '', 'with_front' => false),
            'supports'             => array('title')
	);
	register_post_type('reviews', $args);
}

function customfield($value){
    global $post;
    $customfield = get_post_meta($post->ID, $value, true);
    if(!empty($customfield))
	    return is_array($customfield) ? stripslashes_deep($customfield) : stripslashes(wp_kses_decode_entities($customfield));
    return false;
}

// ADD METABOXES ===>
add_action('add_meta_boxes','add_metaboxes');
function add_metaboxes(){
    add_meta_box('reviews_meta_box','Add a Client Review:','reviews_function','reviews','normal','high');
}

// ADD HTML TO THE INSIDE THE "clients" METABOX ===>
function reviews_function($post){
    wp_nonce_field('the_nonce', 'nonce'); ?>
    <div class="meta-row bbox clearfix">
        <input value="Y" type="hidden" id="update_the_post" name="update_the_post" />
        <?php
            $content  = stripslashes(htmlspecialchars_decode(customfield('the_review'), ENT_QUOTES));
            $settings = array(
                'media_buttons' => false,
                'quicktags' => false,
                'tinymce' => false,
                'teeny' => true
            );
            wp_editor($content,'the_review',$settings);
        ?>
        <label style="margin-top:30px;">Add the Client Name:</label>
        <input value="<?php echo customfield('client_name'); ?>" type="text" id="client_name" name="client_name" />
    </div><?php
}

add_action('save_post','save_this_post');
function save_this_post($post_id) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'the_nonce')) return;
    if( !current_user_can( 'edit_posts' ) ) return;
    if (isset($_POST['update_the_post'])) {
        if(isset($_POST['the_review'])){
            update_post_meta( $post_id, 'the_review', esc_attr($_POST['the_review']));
        }
        if(isset($_POST['client_name'])){
            update_post_meta( $post_id, 'client_name', esc_attr($_POST['client_name']));
        }
    }
}

*/
?>